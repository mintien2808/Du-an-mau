<?php
require_once 'HomeController.php';
require_once 'app/models/EmailService.php';

class UserController extends HomeController {
    private $userDao;
    private $cartDao;
    private $orderDao;
    private $emailService;

    public function __construct() {
        parent::__construct();
        $this->userDao = $this->loadModel('UserDAO');
        $this->cartDao = $this->loadModel('CartDAO');
        $this->orderDao = $this->loadModel('OrderDao');
        $this->emailService = new EmailService();

    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $user = $this->userDao->getUser($username, $password);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['cart'] = $this->cartDao->getCartById($user['id']);
                $this->view->redirect('home');
            } else {
                $this->view->render('user/login', ['error' => 'Sai thông tin đăng nhập']);
            }
        } else {
            $this->view->render('user/login');
        }
    }

    public function register() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirm_password = $_POST['confirm_password'] ?? null;
            $image = $_FILES['image'] ?? null;

            if (empty($username)) {
                $errors['username'] = "Username không được để trống!";
            }

            if (empty($email)) {
                $errors['email'] = "Email không được để trống!";
            }

            if (empty($phone)) {
                $errors['phone'] = "Phone không được để trống!";
            }

            if (empty($password)) {
                $errors['password'] = "Password không được để trống!";
            }

            if (empty($confirm_password)) {
                $errors['confirm_password'] = "Confirm password không được để trống!";
            } else {
                if ($password != $confirm_password) {
                    $errors['confirm_password'] = "Confirm password không trùng khớp!";
                }
            }

            $target_file = "public/img/default.png";
            $role = 'user';
                if (!empty($image['name'])) {
                $target_dir = "public/img/";
                $target_file = $target_dir . basename($image["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($image["tmp_name"]);
                if ($check === false) {
                    $errors['image'] = "File is not an image.";
                } elseif ($image["size"] > 5000000) { 
                    $errors['image'] = "Sorry, your file is too large.";
                } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } elseif (!move_uploaded_file($image["tmp_name"], $target_file)) {
                    $errors['image'] = "Sorry, there was an error uploading your file.";
                }
            }
            if (empty($errors)) {
                if ($this->userDao->checkUserExist($username,$email)) {
                    $errors['exists'] = "Username hoặc Email đã tồn tại!";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $this->userDao->addUser($username, $email, $phone, $hashedPassword, $target_file,$role);
                    $this->view->redirect('login');
                }
            }
        }
        $this->view->render('user/register', ['errors' => $errors]);
    }

    private function isAuthorized($id) {
        return isset($_SESSION['user']) && $_SESSION['user']['id'] == $id;
    }

    public function profile($id) {
        if ($this->isAuthorized($id)) {
            $user = $this->userDao->getUserById($id);
            $orders = $this->orderDao->getOrdersByUserId($id);
            $this->view->render('user/profile', ['user' => $user,'orders' => $orders]);
        } else {
            header("location:404.html");
        }
    }

    public function logout() {
        $this->cartDao->saveCartToDatabase($_SESSION['user']['id'], $_SESSION['cart']); 
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
        session_destroy();
        $this->view->redirect('home');
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_SESSION['user']['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address']; 
    
            if (!empty($_FILES['img']['name'])) {
                $image = $_FILES['img'];
                $target_dir = "public/img/";
                $target_file = $target_dir . basename($image["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                $check = getimagesize($image["tmp_name"]);
                if ($check === false) {
                    $errors['image'] = "File is not an image.";
                } elseif ($image["size"] > 5000000) { 
                    $errors['image'] = "Sorry, your file is too large.";
                } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } elseif (!move_uploaded_file($image["tmp_name"], $target_file)) {
                    $errors['image'] = "Sorry, there was an error uploading your file.";
                } else {
                    $imagePath = $target_file;
                }
            } else {
                $imagePath = $_SESSION['user']['img'];
            }
    
            if (empty($errors) && $this->userDao->ChangeInfoUser($id, $username, $email, $phone, $imagePath, $address)) {
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['img'] = $imagePath;
                header("Location: index.php?url=user/profile/" .$id); 
            } else {
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                } else {
                    echo "Cập nhật thất bại!";
                }
            }
        }
    }
    
    public function fgpass(){
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
             
            if($email){

            $userExist = $this->userDao->checkUserByEmail($email);
                if($userExist){

                $resetToken = bin2hex(random_bytes(16));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $this->userDao->setToken($userExist['id'],$resetToken,$expiry);

                $resetLink = "http://localhost/php/du-an-mau/index.php?url=user/rspass&token=$resetToken";
                $subject = "Password Reset Request";
                $body = "Click the following link to reset your password: $resetLink";

                $this->emailService->sendEmail($email, $subject, $body);

               header("location:/php/du-an-mau/app/view/user/login");
            }
                $errors['invalid']= 'Không tồn tại email này';
            }
        }
        
        $this->view->render('user/fgpw', ['errors' => $errors]);
    }
    public function rspass() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
    
            if ($password === $confirm_password) {
                $user = $this->userDao->getUserByResetToken($token);
    
                if ($user && new DateTime() < new DateTime($user['reset_token_expiry'])) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $this->userDao->updatePassword($user['id'], $hashedPassword);
                    $this->userDao->clearPasswordResetToken($user['id']);
                    header("location:/php/du-an-mau/user/login");
                } else {
                    $errors['A'] = 'Invalid or expired token';
                }
            } else {
                $errors['D'] = 'Password do not match' ;
            }
        }
        $this->view->render('user/repass', ['errors' => $errors]);
    }
}
?>
