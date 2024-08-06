<?php
// OrderController.php
require_once 'HomeController.php';
require_once 'app/models/EmailService.php';

class OrderController extends HomeController {
    private $orderDao;
    private $cartDao;
    private $emailService;
    private $productDAO;
    private $DcodeDao;

    public function __construct() {
        parent::__construct();
        $this->orderDao = $this->loadModel('OrderDao');
        $this->cartDao = $this->loadModel('CartDao');
        $this->emailService = new EmailService();
        $this->productDAO = $this->loadModel('ProductDAO');
        $this->DcodeDao = $this->loadModel('DcodeDao');
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

            $discountCode = $_POST['discount_code'] ?? null;
            $discountAmount = 5000;

            if ($discountCode) {
                $discount = $this->DcodeDao->getDiscountByCode($discountCode);
                if ($discount) {
                    $discountAmount = $discount['amount'];
                }
            }

            $totalAmount -= $discountAmount;
            if ($totalAmount < 10000) {
                $totalAmount = 10000;
            }

            $userId = $_SESSION['user']['id'];
            $user_name = $_SESSION['user']['username'];
            $orderId = $this->orderDao->createOrder($userId, $totalAmount, $shippingAddress, 'pending');

            foreach ($cart as $item) {
                $this->orderDao->addOrderItem($orderId, $item['product_id'], $item['product_name'], $item['product_price'], $item['quantity'], $user_name, $phone);
            }

        } else {
            $discountCodes = $this->DcodeDao->getAllDiscountCodes();
            $this->view->render('orders/checkout', ['discountCodes' => $discountCodes]);
        }
    }
    public function thanks() {
        if (isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $order = explode('_',$orderId);
            $getID = $order[0];
            if ($orderId) {
                $this->orderDao->updateOrderStatus($getID,'shipped','paid');
                $orderDetails = $this->orderDao->getOrderItemsByOrderId($getID);
                foreach ($orderDetails as $detail) {
                    $productId = $detail['product_id'];
                    $quantityOrdered = $detail['quantity'];
                    $this->productDAO->updateProductStock($productId, $quantityOrdered);
                    
                }
                $userEmail = $_SESSION['user']['email'];
                $subject = "Xác nhận đơn hàng";
                $body = "Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xác nhận. Mã đơn hàng: " . $orderId;
                unset($_SESSION['cart']);
                $this->emailService->sendEmail($userEmail, $subject, $body);
                $this->view->render('orders/thanks');
            } else {
                echo 'Lỗi: Đơn hàng không tồn tại.';
            }
        }
    }
    public function reorder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
            $orderId = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
    
            if ($orderId === false) {
                echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
                return;
            }
            $orderDetails = $this->orderDao->getOrderItemsByOrderId($orderId);
            if ($orderDetails) {
                foreach ($orderDetails as $detail) {
                    $productId = $detail['product_id'];
                    $quantity = $detail['quantity'];
                    $name = $detail['product_name'];
                    $price = $detail['product_price'];
                    $product = $this->productDAO->getProductById($detail['product_id']);
                    $img = $product['img'];

                    $_POST['product_id'] = $productId;
                    $_POST['quantity'] = $quantity;
                    $_POST['product_name'] = $name;
                    $_POST['product_price'] = $price;
                    $_POST['quantity'] = $img;
    
                    ob_start();
                    $this->cartDao->addToCart();
                    ob_end_clean();
                }
                echo json_encode(['success' => true, 'message' => 'Reorder successful!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Order not found']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }
    
}
?>
