    <?php
    require_once 'HomeController.php';
    require_once 'app/models/DAO/OrderDAO.php';
    require_once 'app/models/DAO/DcodeDao.php';
        class OnlineController extends HomeController{
            private $orderDao;  
            public function __construct() {
                parent::__construct();
                $this->view = new View();
                $this->orderDao = new OrderDao();
                $this->DcodeDao = new DcodeDao();
            }

            public function online_checkout(){
                    if(isset($_POST['COD'])){
                        echo 'Chúng tôi chưa làm cái này';
                    }elseif(isset($_POST['payUrl'])){
                            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                            $partnerCode = 'MOMOBKUN20180529';
                            $accessKey = 'klm05TvNBzhg7h7j';
                            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                            $orderInfo = "Thanh toán qua MoMo";
                            $amount = "10000";
                            $orderId = rand(00,9999);
                            $redirectUrl = "https://localhost/php/du-an-mau/index.php?url=order/thanks";
                            $ipnUrl = "https://localhost/php/du-an-mau/index.php?url=order/thanks";
                            $extraData = "";
        
                        if (!empty($_POST)){
                            $userName = $_POST['user_name'];
                            $shippingAddress = $_POST['shipping_address'];
                            $phone = $_POST['phone'];
                            $cart = $_SESSION['cart'] ?? [];
                    
                            $totalAmount = array_reduce($cart, function($sum, $item) {
                                return $sum + ($item['product_price'] * $item['quantity']);
                            }, 0);
                    
                            $discountCode = $_POST['discount_code'] ?? null;
                            if ($discountCode) {
                                $discountAmount = $this->DcodeDao->getDiscountAmountByCode($discountCode);
                                if ($discountAmount) {
                                    $totalAmount -= $discountAmount;
                                    if ($totalAmount < 10000) {
                                        $totalAmount = 10000;
                                    }
                                } else {
                                    $this->view->render('orders/checkout', ['error' => 'Mã giảm giá không hợp lệ.']);
                                    return;
                                }
                            }
                    
                            $userId = $_SESSION['user']['id'];
                            $orderIds = $this->orderDao->createOrder($userId, $totalAmount, $shippingAddress, 'pending');
                            
                            foreach ($cart as $item) {
                                $this->orderDao->addOrderItem($orderIds, $item['product_id'], $item['product_name'], $item['product_price'], $item['quantity'], $userName, $phone);
                            }
                                $uniqueOrderId = $orderIds . '_' . time();
                                $partnerCode = $partnerCode;
                                $accessKey = $accessKey;
                                $serectkey = $secretKey;
                                $orderId = $uniqueOrderId;
                                $orderInfo = $orderInfo;
                                $amount = $totalAmount;
                                $ipnUrl = $ipnUrl;
                                $redirectUrl = $redirectUrl;
                                $extraData = $extraData;
                                $requestId = time() . "";
                                $requestType = "payWithATM";
                                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                                //before sign HMAC SHA256 signature
                                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                                $data = array('partnerCode' => $partnerCode,
                                    'partnerName' => "Test",
                                    "storeId" => "MomoTestStore",
                                    'requestId' => $requestId,
                                    'amount' => $amount,
                                    'orderId' => $orderId,
                                    'orderInfo' => $orderInfo,
                                    'redirectUrl' => $redirectUrl,
                                    'ipnUrl' => $ipnUrl,
                                    'lang' => 'vi',
                                    'extraData' => $extraData,
                                    'requestType' => $requestType,
                                    'signature' => $signature);
                                $result = $this->execPostRequest($endpoint, json_encode($data));
                                $jsonResult = json_decode($result, true);
                                header('Location: ' . $jsonResult['payUrl']);
                        }
                    }
            }
            public function execPostRequest($url, $data){
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data))
                    );
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    return $result;
            }
    }

    ?> 