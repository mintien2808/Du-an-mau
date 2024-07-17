<?php
require_once 'HomeController.php';
require_once 'app/models/DAO/UserDAO.php';

class UserController extends HomeController {
    private $userDao;

    public function __construct() {
        parent::__construct();
        $this->userDao = new UserDAO();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $user = $this->userDao->getUser($username, $password);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $this->view->redirect('../home');
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
                if ($this->userDao->getUser($username)) {
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
    public function profile() {
        $this->view->render('user/profile', ['user' => $_SESSION['user']]);
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        $this->view->redirect('home');
    }
}
?>
