<?php
require_once __DIR__ . '/../../../config/database.php';

class CartDao {
    private $table = 'cart';
    public $database;
    public $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCartById($userId){
        try {
            $stmt = $this->db->prepare("SELECT * FROM `cart` WHERE `user_id` = ?");
            $stmt->execute([$userId]);
            $cartData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $cart = [];
            foreach ($cartData as $item) {
                $cart[$item['product_id']] = $item;
            }
            return $cart;
        } catch (PDOException $e) {
            error_log("Lỗi SQL: " . $e->getMessage());
            return [];
        }
    }

    public function getAllCart(){
        $stmt = $this->db->prepare("SELECT * FROM" . $this->table );
        $stmt ->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function addToCart() {
        session_start();  // Ensure the session is started
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $productName = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
            $productPrice = filter_input(INPUT_POST, 'product_price', FILTER_VALIDATE_FLOAT);
            $productImg = filter_input(INPUT_POST, 'product_img', FILTER_SANITIZE_STRING);
    
            if (!$productId || !$quantity || !$productPrice) {
                echo "Dữ liệu không hợp lệ.";
                return;
            }
    
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
    
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                
                $_SESSION['cart'][$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product_name' => $productName,
                    'product_price' => $productPrice,
                    'product_img' => $productImg
                ];
            }
    
            echo "Sản phẩm đã được thêm vào giỏ hàng.";
        } else {
            http_response_code(405); 
            echo "HTTP Method Not Allowed.";
        }
    }
    
    public function updateCartDatabase($productId, $productDetails) {
        $sql = "UPDATE cart SET quantity = ?, product_name = ?, product_price = ?, product_img = ? WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $productDetails['quantity'],
            $productDetails['product_name'],
            $productDetails['product_price'],
            $productDetails['product_img'],
            $productId
        ]);
    }

    public function saveCartToDatabase($userId, $cartData) {
        $sql = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
    
        $sql = "INSERT INTO cart (user_id, product_id, quantity, product_name, product_price, product_img) VALUES (?, ?, ?, ?, ?, ?)";
        foreach ($cartData as $item) {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $userId,
                $item['product_id'],
                $item['quantity'],
                $item['product_name'],
                $item['product_price'],
                $item['product_img']
            ]);
        }
    }
    
}
    
 ?>