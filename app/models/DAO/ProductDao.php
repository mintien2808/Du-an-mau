<?php
require_once __DIR__ . '/../../../config/database.php';
class ProductDAO {
    private $table = "product";
    private $categoryTable = "categories";

    //PRODUCT
    
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
        $stmt = $db->prepare("INSERT INTO " . $this->table . " (name, price, quantity, img,description,id_category) VALUES (?, ?, ?, ?,?,?)");
        return $stmt->execute([$name,$price,$quantity, $image,$description,$id_cate]);
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

    public function getRelatedProducts($categoryId, $productId) {
        $database = new Database();
        $db = $database->getConnection();
        $productsPerPage = 5; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $productsPerPage;
        $stmt = $db->prepare("
            SELECT * FROM product 
            WHERE id_category = :categoryId 
            AND id != :productId 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $productsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalRelatedProducts($categoryId, $productId) {
        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("
            SELECT COUNT(*) 
            FROM product 
            WHERE id_category = :categoryId 
            AND id != :productId
        ");
        
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }

    public function updateProductStock($product_id,$quantityOrdered) {  
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT quantity FROM product WHERE id = :product_id");
        $stmt->execute([':product_id' => $product_id]);
        $currentStock = $stmt->fetchColumn();
        $newStock = $currentStock - $quantityOrdered;   
        $stmt = $db->prepare("UPDATE product SET quantity = :newStock WHERE id = :product_id");
        $stmt->execute([
            ':newStock' => $newStock,
            ':product_id' => $product_id
        ]);
    }

    // CATEGORIES
    
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

    public function getCategory($id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategory($name, $img) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("INSERT INTO categories (name, img) VALUES (?, ?)");
        return $stmt->execute([$name, $img]);
    }

    public function updateCategory($id, $name,$img) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE categories SET name = ?, img = ? WHERE id = ?");
        return $stmt->execute([$name, $img, $id]);
    }

    public function DeleteCategory($id) {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>