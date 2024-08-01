<?php
require_once 'HomeController.php';
class ReviewController extends HomeController {
    private $reviewDAO;

    public function __construct() {
        parent::__construct();
        $this->reviewDAO = $this->loadModel('ReviewDAO'); 
    }

    public function editReview(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reviewId = $_POST['review_id'];
            $comment = $_POST['comment'];
            $rating = $_POST['rating'];

            if ( $rating > 5 || $rating < 1 ) {
                echo json_encode(['success' => false, 'message' => 'Invalid Rating']);
            }
            if ($this->reviewDAO->updateReview($reviewId, $comment, $rating)) {
                echo json_encode(['success' => true, 'message' => 'Review updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update review']);
            }
        }
    }

    public function deleteReview() {
        $reviewId = isset($_GET['id']) ? $_GET['id'] : null;
        $productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;
        if ($reviewId && $productId) {
            $deleteSuccess = $this->reviewDAO->deleteReview($reviewId);
            if ($deleteSuccess) {
                header('Location: index.php?url=product/detail/' . $productId);
                exit();
            } else {
                echo "Failed to delete review. Please try again.";
            }
        } else {
            echo "Invalid parameters provided.";
        }
    }
}