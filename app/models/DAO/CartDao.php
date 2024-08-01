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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $productName = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
            $productPrice = filter_input(INPUT_POST, 'product_price', FILTER_VALIDATE_FLOAT);
            $productImg = filter_input(INPUT_POST, 'product_img', FILTER_SANITIZE_STRING);
            
            if ($productId === false || $quantity === false || $quantity <= 0 || $productPrice === false || $productPrice < 0) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
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
            echo json_encode(['success' => true, 'message' => 'Product added to cart']);    
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'HTTP Method Not Allowed']);
        }
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

    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        unset($_SESSION['cart']);
    }
}
    
 ?>