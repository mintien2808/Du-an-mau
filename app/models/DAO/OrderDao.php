<?php
require_once '../du-an-mau/config/database.php';
class OrderDao {
    private $db;
    private $datab;

    public function __construct() {
        $datab = new Database();
        $this->db = $datab ->getConnection();
    }

    public function createOrder($userId, $totalAmount, $shippingAddress, $paymentStatus) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, order_date, shipping_address, total_amount, payment_status) VALUES (?, NOW(), ?, ?, ?)");
        $stmt->execute([$userId, $shippingAddress, $totalAmount, $paymentStatus]);
        return $this->db->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $productName, $productPrice, $quantity,$user_name,$phone) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_price, quantity, total_price,user_name,phone) VALUES (?, ?, ?, ?, ?, ?,?,?)");
        $stmt->execute([$orderId, $productId, $productName, $productPrice, $quantity, $productPrice * $quantity,$user_name,$phone]);
    }

    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
        $stmt->execute([$status, $orderId]);
    }

    public function updateOrderPaymentStatus($orderId, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        $stmt->execute([$status, $orderId]);
    }
}
?>
