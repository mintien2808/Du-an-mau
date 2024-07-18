<?php
require_once __DIR__ . '/../../../config/database.php';

    class AdminDAO {
        private $table = "user";
        public $database;
        public $db;

    public function __construct(
    ){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getUser($username ) {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE username = ? ");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUser(){
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adduser($username, $email, $phone, $hashedPassword, $imagePath, $role,$address) {
        $stmt = $this->db->prepare("INSERT INTO " . $this->table . " (username, email, phone, password, img, role,address) VALUES (?, ?, ?, ?, ?, ?,?)");
        return $stmt->execute([$username, $email, $phone, $hashedPassword, $imagePath, $role,$address]);    
    }

    public function ChangeInfoUser($id, $username, $email, $phone, $hashedPassword,$imagePath,$address, $role){
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET username = ?, email = ?, phone = ?, password = ?, img = ?,address =?, role = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $phone, $hashedPassword, $imagePath, $address,$role, $id]);
    }

    public function DeleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    
    #PRODUCT 

}

?>

