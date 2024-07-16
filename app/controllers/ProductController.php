<?php
require_once 'HomeController.php';

class ProductController extends HomeController {
    private $productDAO;
    private $categoryTable = "categories";

    public function __construct() {
        parent::__construct();
        $this->productDAO = $this->loadModel('ProductDAO');
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
        $this->view->render('products/detail', ['product' => $product]);
    }

    public function addToCart($id) {
        $product = $this->productDAO->getProductById($id);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $cartItem = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1
        ];
        $_SESSION['cart'][] = $cartItem;
        header('Location: index.php?url=cart');
    }
    
}
?>
