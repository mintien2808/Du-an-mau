<?php
require_once __DIR__ . '/../../../config/database.php';
class ProductDAO {
    private $table = "product";
    private $categoryTable = "categories";
    
    public function getAllProducts() {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price, $image,$quantity) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("INSERT INTO " . $this->table . " (name, description, price, image,quantity) VALUES (?, ?, ?, ?,?)");
        return $stmt->execute([$name, $description, $price, $image,$quantity]);
    }

    public function updateProduct($id, $name, $description, $price, $image,$quantity) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE " . $this->table . " SET name = ?, description = ?, price = ?, image = ?, quantity = ?  WHERE id = ? ");
        return $stmt->execute([$name, $description, $price, $image, $id,$quantity]);
    }

    public function deleteProduct($id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getProductsByCategory($category_id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE category_id = ?");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " .$this->categoryTable);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>