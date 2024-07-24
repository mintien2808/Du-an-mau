<?php
require_once __DIR__ . '/../../../config/database.php';

class ReviewDAO {
    private $table = "feedback";
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create
    public function createReview($productId, $userId, $username, $comment, $rating) {
        $query = "INSERT INTO " . $this->table . " (product_id, user_id, username, comment, rating, created_at) VALUES (:product_id, :user_id, :username, :comment, :rating, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':rating', $rating);
        return $stmt->execute();
    }

    public function getAllReview() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReviewsByProductId($productId) {
        $query = "SELECT * FROM " . $this->table . " WHERE product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateReview($id, $comment, $rating) {
        $query = "UPDATE " . $this->table . " SET comment = :comment, rating = :rating WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteReview($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
