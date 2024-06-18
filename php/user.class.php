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
// Example implementation of User class with series management
// Define the SeriesManager class
class SeriesManager {
    private $conn; // Database connection object

    // Constructor to initialize with database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to fetch all series from the database
    public function getAllSeries() {
        $query = "SELECT * FROM serie"; // Adjust SQL query as per your database schema
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all rows as associative array
    }

    // Method to update series details
    public function updateSerie($update_data) {
        // Implement update logic here
    }

    // Method to delete a series
    public function deleteSerie($serie_id) {
        // Implement delete logic here
    }
}


?>
