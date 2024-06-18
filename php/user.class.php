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
    }

    public function deleteSerie($serie_id) {
    }
}


?>
