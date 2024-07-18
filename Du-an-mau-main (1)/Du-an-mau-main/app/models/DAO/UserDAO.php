<?php
require_once __DIR__ . '/../../../config/database.php';
class UserDAO {
    private $table = "user";

    public function getUser($username ) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? ");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($username, $email, $phone, $hashedPassword, $imagePath,$role) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("INSERT INTO " . $this->table . " (username, email, phone, password, img,role) VALUES (?, ?, ?, ?, ?,?)");
        return $stmt->execute([$username, $email, $phone, $hashedPassword, $imagePath,$role]);
    }
    
    public function getUserById($id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");    
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
