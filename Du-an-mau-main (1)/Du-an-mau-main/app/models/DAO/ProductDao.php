<?php
require_once __DIR__ . '/../../../config/database.php';
class ProductDAO {
    private $table = "product";
    private $categoryTable = "categories";
    private $cartTable = 'cart';
    
    public function getAllProducts() {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM " . $this->table );
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

    public function addProduct($name, $description, $price, $image,$quantity,$id_cate) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("INSERT INTO " . $this->table . " (name, description, price, img,quantity,id_category) VALUES (?, ?, ?, ?,?,?)");
        return $stmt->execute([$name, $description, $price, $image,$quantity,$id_cate]);
    }

    public function updateProduct($id, $name, $price, $quantity, $description, $image, $id_cate) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE " . $this->table . " SET name = ?, price = ?, quantity = ?, description = ?, img = ?, id_category = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $quantity, $description, $image, $id_cate, $id]);
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
        $stmt = $db->prepare("SELECT * FROM " . $this->table . " WHERE id_category = ?");
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
    
    public function addtoCart ($user_id,$product_id, $price_product, $total_price,$img,$quantity) {
        $database = new Database();
        $db = $database->getConnection();
        $user_id = $_SESSION['user']['id'];
        $stmt = $db->prepare("INSERT INTO " . $this->cartTable . " (user_id,product_id,price_product,quantity,total_price,img) VALUES ( ?, ?, ?,?,?,?)");
        return $stmt -> execute($user_id,$product_id, $price_product, $total_price,$img,$quantity);
    }

}
?>