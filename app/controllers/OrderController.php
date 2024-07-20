<?php
// OrderController.php
require_once 'HomeController.php';
require_once 'app/models/DAO/OrderDao.php';
require_once 'app/models/DAO/CartDao.php';
require_once 'app/models/EmailService.php';


class OrderController extends HomeController {
    private $orderDao;
    private $cartDao;
    private $emailService;

    public function __construct() {
        parent::__construct();
        $this->orderDao = new OrderDao();
        $this->cartDao = new CartDao();
        $this->emailService = new EmailService();
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $shippingAddress = $_POST['shipping_address'];
            $phone = $_POST['phone'];
            $cart = $_SESSION['cart'] ?? [];
            if (empty($cart)) {
                $this->view->redirect('cart/viewCart');
                return;
            }
    
            $totalAmount = array_reduce($cart, function($sum, $item) {
                return $sum + ($item['product_price'] * $item['quantity']);
            }, 0);
    
            $userId = $_SESSION['user']['id'];
            $user_name =$_SESSION['user']['username'];
            $orderId = $this->orderDao->createOrder($userId, $totalAmount, $shippingAddress, 'pending');
    
            foreach ($cart as $item) {
                $this->orderDao->addOrderItem($orderId, $item['product_id'], $item['product_name'], $item['product_price'], $item['quantity'],$user_name,$phone);
            }
        } else {
            $this->view->render('orders/checkout');
        }
    }
    public function thanks() {
        if (isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $order = 1;
            if ($order) {
                $userEmail = $_SESSION['user']['email'];
                $subject = "Xác nhận đơn hàng ";
                $body = "Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xác nhận. Mã đơn hàng: ";

                $this->emailService->sendEmail($userEmail, $subject, $body);
                var_dump($this->emailService);
            } else {
                echo 'Lỗi: Đơn hàng không tồn tại.';
            }
        }
    }
}

?>
