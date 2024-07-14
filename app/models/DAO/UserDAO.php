<?php
require_once __DIR__ . '/../../../config/database.php';
class UserDAO {
    private $table = "user";
    public function getUser($username, $password ) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function checkUserExists($username, $email) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function addUser($username, $email, $phone, $hashedPassword, $imagePath) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("INSERT INTO " . $this->table . " (username, email, phone, password, img) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $phone, $hashedPassword, $imagePath]);
    }
}
?>
