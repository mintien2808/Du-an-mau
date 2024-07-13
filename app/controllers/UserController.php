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
            if ($user) {
                $_SESSION['user'] = $user;
                $this->view->redirect('/index');
            } else {
                $this->view->render('user/login', ['error' => 'Invalid credentials']);
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

            if (empty($errors)) {
                if ($this->userDao->checkUserExists($username, $email)) {
                    $errors['exists'] = "Username hoặc Email đã tồn tại!";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $this->userDao->addUser($username, $email, $phone, $hashedPassword);
                    $this->view->redirect('user/login');
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
