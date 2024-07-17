<?php
require_once 'core/View.php';
class HomeController {
    protected $view;
    private $productDAO;
    
    public function __construct() {
        $this->view = new View();
        $this->productDAO = new ProductDAO();
    }

    public function loadModel($model) {
        require_once 'app/models/DAO/' . $model . '.php';
        return new $model();
    }

    public function index() {
        $products = $this->productDAO->getAllProducts();
        $categories = $this->productDAO->getAllCategories();
        $this->view->render('home', ['products' => $products, 'categories' => $categories]);
    }
    
}
?>


