<?php
require_once 'HomeController.php';

class ProductController extends HomeController {
    private $productDAO;
    private $categoryTable = "categories";
    private $reviewDAO;
    private $orderDao;

    public function __construct() {
        parent::__construct();
        $this->productDAO = $this->loadModel('ProductDAO');
        $this->reviewDAO = $this->loadModel('ReviewDAO'); 
        $this->orderDao = $this->loadModel('OrderDao'); 
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

    public function search() {
        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : ''; 
        if (!empty($searchTerm)) {
            $products = $this->productDAO->searchProducts($searchTerm);
        } else {
            $products = [];
        }
        $categories = $this->productDAO->getAllCategories();
        $this->view->render('home', [
            'products' => $products, 
            'categories' => $categories, 
            'searchTerm' => $searchTerm
        ]);
    }
    

    public function detail($id) {
        $product = $this->productDAO->getProductById($id);
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $productsPerPage = 5;
        
        $relatedProducts = $this->productDAO->getRelatedProducts($product['id_category'], $id, $page, $productsPerPage);
    
        $totalProducts = $this->productDAO->getTotalRelatedProducts($product['id_category'], $id);
        $totalPages = ceil($totalProducts / $productsPerPage);
        
        $categories = $this->productDAO->getAllCategories();
        $reviews = $this->reviewDAO->getReviewsByProductId($id);
        $userPurchased = false;
        if (isset($_SESSION['user'])) {
            $userPurchased = $this->orderDao->hasPurchasedProduct($_SESSION['user']['username'], $id);
        }
        $this->view->render('products/detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'categories' => $categories,
            'reviews' => $reviews,
            'totalPages' => $totalPages,
            'userPurchased'=>$userPurchased,
            'page' => $page
        ]);
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
