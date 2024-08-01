<?php
require_once __DIR__ . '/../../../config/database.php';
class UserDAO {
    private $table = "user";

    public function getUser($username) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? ");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function checkUserExist($username, $email) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? AND email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function checkUserByEmail($email){
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setToken($userId, $resetToken, $expiry){
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE user SET reset_token = ?, reset_token_expiry = ? WHERE id = ?");
        $stmt->execute([$resetToken, $expiry, $userId]);
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

    public function ChangeInfoUser($id, $username, $email, $phone,$imagePath,$address){
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE " . $this->table . " SET username = ?, email = ?, phone = ?, img = ?,address =? WHERE id = ?");
        return $stmt->execute([$username, $email, $phone, $imagePath, $address, $id]);
    }   

    public function getUserByResetToken($token) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE reset_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($userId, $password) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->execute([$password, $userId]);
    }

    public function clearPasswordResetToken($userId) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE user SET reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        $stmt->execute([$userId]);
    }


}
?>
