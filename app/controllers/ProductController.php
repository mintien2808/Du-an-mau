<?php
require_once 'HomeController.php';

class ProductController extends HomeController {
    private $productDAO;
    private $categoryTable = "categories";
    private $reviewDAO;

    public function __construct() {
        parent::__construct();
        $this->productDAO = $this->loadModel('ProductDAO');
        $this->reviewDAO = $this->loadModel('ReviewDAO'); 
    }

    public function index() {
        $products = $this->productDAO->getAllProducts();
        $categories = $this->productDAO->getAllCategories();
        $this->view->render('home', ['products' => $products, 'categories' => $categories]);
    }

    public function showByCategory($category_id) {
        $products = $this->productDAO->getProductsByCategory($category_id);
        $categories = $this->productDAO->getAllCategories();
        $this->view->render('home', ['products' => $products, 'categories' => $categories]);
    }

    public function detail($id) {
        $product = $this->productDAO->getProductById($id);
        $relatedProducts = $this->productDAO->getRelatedProducts($product['id_category'], $id);
        $categories = $this->productDAO->getAllCategories();
        $reviews = $this->reviewDAO->getReviewsByProductId($id); 
        $this->view->render('products/detail', ['product' => $product, 'relatedProducts' => $relatedProducts, 'categories' => $categories, 'reviews' => $reviews]);
    }

    public function addReview(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    
            if ($productId === false || $userId === false || $username === false || $comment === false || $rating === false || $rating < 1 || $rating > 5) {
                echo json_encode(['success' => false, 'message' => 'Điểm số từ 1- 5']);
                return;
            }

            if ($this->reviewDAO->createReview($productId, $userId, $username, $comment, $rating)) {
                echo json_encode(['success' => true, 'message' => 'Review added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add review']);
            }
        }
    }
}
?>
