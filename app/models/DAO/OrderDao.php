<?php
require_once __DIR__ . '/../../../config/database.php';
class OrderDao {
    public $database;
    public $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
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

    public function updateOrderStatus($orderId, $status,$stat) {
        $stmt = $this->db->prepare("UPDATE orders SET order_status = ? , payment_status = ? WHERE id = ?");
        $stmt->execute([$status,$stat, $orderId]);
    }

    public function getOrdersByUserId($user_id) {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = ?');
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItemsByOrderId($order['id']);
        }

        return $orders;
    }

    public function getOrderItemsByOrderId($order_id) {
        $stmt = $this->db->prepare('SELECT * FROM order_items WHERE order_id = ?');
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders() {
        $stmt = $this->db->prepare('SELECT * FROM orders');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllOrder_items() {
        $stmt = $this->db->prepare('SELECT * FROM order_items');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function hasPurchasedProduct($user_name, $productId) {
        $query = $this->db->prepare("SELECT COUNT(*) FROM order_items WHERE user_name = :user_name AND product_id = :product_id");
        $query->execute(['user_name' => $user_name, 'product_id' => $productId]);
        return $query->fetchColumn() > 0;
    }

    public function deleteOrders($id) {
        try {
            $this->db->beginTransaction();
            $query = $this->db->prepare('DELETE FROM order_items WHERE order_id = :order_id');
            $query->bindParam(':order_id', $id, PDO::PARAM_INT);
            $query->execute();
            $query = $this->db->prepare('DELETE FROM orders WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function getAllOrdersWithDetails() {
        $query = $this->db->prepare("
            SELECT 
                o.id AS order_id,
                o.user_id,
                o.total_amount,
                o.order_date,
                od.product_id,
                od.quantity,
                od.product_price
            FROM orders o
            JOIN order_items od ON o.id = od.order_id
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
