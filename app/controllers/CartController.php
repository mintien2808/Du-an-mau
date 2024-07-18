
<?php
require_once('HomeController.php'); 
require_once 'app/models/DAO/CartDAO.php';
    class CartController extends HomeController{
        private $cart = "cart";
        public function __construct() {
            parent::__construct();
            $this->cartDao = new CartDAO();
        }

        public function addToCart() {
        $cart = $this->cartDao->addToCart();
        }   
        public function viewCart() {
            $cart = $_SESSION['cart'] ?? [];
            $this->view->render('cart/view', ['cart' => $cart]);
        }
        
}
 ?> 