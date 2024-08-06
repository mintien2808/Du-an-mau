
<?php
require_once('HomeController.php'); 
    class CartController extends HomeController{
        private $cart = "cart";
        
        public function __construct() {
            parent::__construct();
            $this->cartDao = $this->loadModel('CartDao');
        }

        public function addToCart() {
        $cart = $this->cartDao->addToCart();
        
        }   
        public function viewCart() {
            $cart = $_SESSION['cart'] ?? [];
            $this->view->render('cart/view', ['cart' => $cart]);
        }

        public function updateCart() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                foreach ($_POST['cart'] as $key => $item) {
                    if (isset($_SESSION['cart'][$key])) {
                        $_SESSION['cart'][$key]['quantity'] = $item['quantity'];
                    }
                }
                $this->viewCart();
            }
        }
        
        public function removeFromCart($productId) {
            if (isset($_SESSION['cart'][$productId])) {
                unset($_SESSION['cart'][$productId]);
            }
            $this->viewCart();
        }

}
 ?> 