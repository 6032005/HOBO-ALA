<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;

    }

    public function getAllUsers() {
        $query = "SELECT id, username, email, contentmanager, admin FROM users";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateUser($data) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email, admin = :admin, contentmanager = :contentmanager WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':admin', $data['admin']);
            $stmt->bindParam(':contentmanager', $data['contentmanager']);
            $stmt->bindParam(':id', $data['id']);
            
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }}

    class SeriesManager {
        private $conn;
    
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function getAllSeries() {
            $query = "SELECT * FROM serie";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function updateSerie($update_data) {
            try {
                $sql = "UPDATE serie SET SerieTitel = :SerieTitel, Actief = :Actief WHERE SerieID = :SerieID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':SerieID', $update_data['SerieID']);
                $stmt->bindParam(':SerieTitel', $update_data['SerieTitel']);
                $stmt->bindParam(':Actief', $update_data['actief']);
                return $stmt->execute();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    
        public function deleteSerie($serie_id) {
            try {
                $sql = "DELETE FROM serie WHERE SerieID = :SerieID";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':SerieID', $serie_id);
                return $stmt->execute();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    
        public function insertSerie($serie_data) {
            try {
                $sql = "INSERT INTO serie (SerieTitel, Actief) VALUES (:SerieTitel, :Actief)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':SerieTitel', $serie_data['SerieTitel']);
                $stmt->bindParam(':Actief', $serie_data['Actief']);
                return $stmt->execute();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
    
?>
