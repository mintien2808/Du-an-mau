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

    public function addtoCart($id){
        $product = $this->productDAO->getProductById($id);
        $cart = $this->productDAO->addtoCart();
    }
}
?>
