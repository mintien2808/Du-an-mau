<?php
require_once('HomeController.php');
class AdminController extends HomeController {

    private $AdminDao;
    private $productDao;
    private $UserDao;
    private $orderDao;
    private $ReviewDao;
    private $DcodeDao;

    public function __construct() {
        parent::__construct();
        $this->AdminDao = $this->loadModel('AdminDAO');
        $this->productDao = $this->loadModel('ProductDAO');
        $this->UserDao = $this->loadModel('UserDAO');
        $this->orderDao = $this->loadModel('OrderDao');
        $this->ReviewDao = $this->loadModel('ReviewDAO');
        $this->DcodeDao = $this->loadModel('DcodeDao');
    }
      
    public function index(){
        $users = $this->AdminDao->getAllUser();
        $products = $this->productDao->getAllProducts();
        $categories = $this->productDao->getAllCategories();
        $orders = $this->orderDao->getAllOrders();
        $Reviews = $this->ReviewDao->getAllReview();
        $code = $this->DcodeDao->getAllDiscountCodes();
        $orderdetail = $this->orderDao->getAllOrder_items();
        $orderDetailsort = $this->orderDao->getAllOrdersWithDetails();
        $this->view->render('admin/home', [
            'users' => $users,
            'products' => $products,
            'categories' => $categories,
            'orders' => $orders,
            'reviews' => $Reviews,
            'coupons' => $code,
            'orderdetail' => $orderdetail,
            'orderDetails' => $orderDetailsort
        ]);
    }

   #USER
    public function DeleteUser($id){
        $deleteUser = $this->AdminDao->DeleteUser($id);
        header('Location: index.php?url=admin/index');
    }

    public function adduser() {
        $errors = [];
        $role ='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $password = $_POST['password'] ?? null;
            $address = $_POST['address'] ?? null;
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
            if (empty($address)) {
                $errors['address'] = "thiếu địa chỉ";
            }
            $target_file = "public/img/default.png";
            $role = $_POST['role'];
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
                if ($this->UserDao->checkUserExist($username,$email)) {
                    $errors['exists'] = "Username hoặc Email đã tồn tại!";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $this->AdminDao->adduser($username, $email, $phone, $hashedPassword, $target_file, $role,$address);
                    $this->view->redirect('admin/index');
                }
            }
        }
        $this->view->render('admin/Form-add', ['errors' => $errors]);
    }

    public function ChangeUserInfo($id) {
        $errors = [];
        $user = $this->UserDao->getUserById($id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $password = $_POST['password'] ?? null;
            $address = $_POST['address'] ?? null;
            $image = $_FILES['image'] ?? null;
    
            if (empty($phone)) {
                $phone = $user['phone'];
            } elseif (!preg_match('/^\d{10,15}$/', $phone)) {
                $phone = $user['phone'];
            }
    
            if ($this->UserDao->getUser($username)) {
                $username = $user['username'];
            }
    
            $target_file = $user['img'];
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
                $hashedPassword = empty($password) ? $user['password'] : password_hash($password, PASSWORD_DEFAULT);
                $this->AdminDao->ChangeInfoUser($id, $username, $email, $phone, $hashedPassword, $target_file, $address, $_POST['role']);
                header('Location: index.php?url=admin/index');
                exit;
            }
        }
    
        $this->view->render('admin/index', ['errors' => $errors, 'user' => $user]);
    }
    


    #PRODUCT 
    public function AddProduct(){
        $errors = [];
        $categories = $this->productDao->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $price = $_POST['price'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $description = $_POST['description'] ?? null;
            $category_id = $_POST['category'] ?? null;
            $image = $_FILES['image'] ?? null;

            if (empty($name)) {
                $errors['name'] = "Tên sản phẩm không được để trống!";
            }

            if (empty($price)) {
                $errors['price'] = "Giá sản phẩm không được để trống!";
            }

            if (empty($quantity)) {
                $errors['quantity'] = "Số lượng không được để trống!";
            }

            if (empty($description)) {
                $errors['description'] = "Mô tả không được để trống!";
            }

            if (empty($category_id)) {
                $errors['category'] = "Danh mục không được để trống!";
            }

            $target_file = "public/img/default.png"; 
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
                $this->productDao->addProduct($name, $description, $price, $target_file,$quantity, $category_id);
                $this->view->redirect('admin/index');
            }
        }

        $this->view->render('admin/AddProduct', ['errors' => $errors, 'categories' => $categories]);
    }

    public function DeleteProduct($id){
        $deleteUser = $this->productDao->deleteProduct($id);
        header('Location: index.php?url=admin/index');
    }

    public function UpdateProduct($id){
        $errors = [];
        $product = $this->productDao->getProductById($id);
        $categories = $this->productDao->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $price = $_POST['price'] ?? null;
            $description = $_POST['description'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $image = $_FILES['image'] ?? null;
            $id_cate =$_POST['id_cate'];
    
            if (empty($name)) {
                $errors['name'] = "name không được để trống!";
            }
    
            if (empty($price)) {
                $errors['price'] = "price không được để trống!";
            }
    
            if (empty($description)) {
                $errors['description'] = "description không được để trống!";
            }
    
            if (empty($quantity)) {
                $errors['quantity'] = "quantity không được để trống!";
            }
    
            if (empty($image)) {
                $errors['image'] = "image không được để trống!";
            }
    
            $target_file = $product['img']; 
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
                $this->productDao->updateProduct($id, $name, $price, $quantity, $description, $target_file, $id_cate);
                header('Location: index.php?url=admin/index');
                exit;
            }
        }
    
        $this->view->render('admin/updateProduct', ['errors' => $errors, 'product' => $product,'categories'=>$categories]);
    }
    
    #CATEGORY 
    
    public function AddCategory(){
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $image = $_FILES['image'] ?? null;

            if (empty($name)) {
                $errors['name'] = "Tên Danh mục không được để trống!";
            }

            if (empty($image)) {
                $errors['image'] = " Ảnh Danh mục không được để trống!";
            }

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
                $this->productDao->AddCategory($name, $target_file);
                $this->view->redirect('admin/index');
            }
        }
        $this->view->render('admin/AddCategory', ['errors' => $errors]);
    }

    public function DeleteCategory($id){
        $deleteUser = $this->productDao->DeleteCategory($id);
        header('Location: index.php?url=admin/index');
    }

    public function UpdateCategory($id){
        $errors = [];
        $categories = $this->productDao->getCategory($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $image = $_FILES['image'] ?? null;
    
            if (empty($name)) {
                $errors['name'] = "name không được để trống!";
            }
    
            if (empty($image)) {
                $errors['image'] = "image không được để trống!";
            }
            
            $target_file = $categories['img']; 
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
                $this->productDao->UpdateCategory($id,$name,$target_file);
                header('Location: index.php?url=admin/index');
                exit;
            }
        }
    
        $this->view->render('admin/UpdateCategory', ['errors' => $errors,'categories'=>$categories]);
    }

    #Review 
    public function editReview($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $comment = $_POST['comment'];
            $rating = $_POST['rating'];

            if ( $rating > 5 || $rating < 1 ) {
                echo json_encode(['success' => false, 'message' => 'Invalid Rating']);
            }
            if ($this->ReviewDao->updateReview($id, $comment, $rating)) {
                header('Location: index.php?url=admin/index');
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update review']);
            }
        }
        $this->view->render('admin/updateReview');
    }

    public function DeleteReview($id) {
        $deleteUser = $this->ReviewDao-> deleteReview($id);
        header('Location: index.php?url=admin/index');
    }

    public function addReview(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
            $userId = $_POST['user_id'];
            $productId = $_POST['product_id'];
            $username = $_POST['username'];
    
            $errors = [];
    
            // Validate inputs
            if (empty($rating) || $rating < 1 || $rating > 5) {
                $errors['rating'] = "Điểm đánh giá phải từ 1 đến 5.";
            }
            if (empty($comment)) {
                $errors['comment'] = "Bình luận không được để trống.";
            }
            if (empty($userId)) {
                $errors['user_id'] = "ID người dùng không được để trống.";
            }
            if (empty($productId)) {
                $errors['product_id'] = "ID sản phẩm không được để trống.";
            }
            if (empty($username)) {
                $errors['username'] = "Tên không được để trống.";
            }
    
            if (count($errors) === 0) {
                
                $this->ReviewDao->createReview($productId, $userId, $username, $comment, $rating);
                $this->view->redirect('admin/index');
                exit;
            } else {
                $this->view->render('admin/addReview', ['errors' => $errors]);
            }
        } else {
            $this->view->render('admin/addReview');
        }
    }
    #Order 

    public function DeleteOrder($id){
        $deleteUser = $this->orderDao->deleteOrders($id);
        header('Location: index.php?url=admin/index');
    }

    #coupons

    public function  DeleteCoupons($id) {
            $this->DcodeDao->deleteDcode($id);
            header('Location: index.php?url=admin/index');
    }
    
    public function FixCouPons($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $code = trim($_POST['code']);
                $amount = trim($_POST['amount']);
                $expiryDate = trim($_POST['expiry_date']);
                $errors = [];
        
                if (empty($code)) {
                    $errors['code'] = 'Mã giảm giá không được để trống.';
                }
                if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
                    $errors['amount'] = 'Số tiền giảm phải là một số dương.';
                }
                if (empty($expiryDate)) {
                    $errors['expiry_date'] = 'Ngày hết hạn không được để trống.';
                } 

                if (empty($errors)) {
                    $this->DcodeDao->Update($id, $code, $amount, $expiryDate);
                    header('Location: index.php?url=admin/index');
                    exit;
                }else{
                    $this->view->render('admin/updateCoupons', ['errors' => $errors, 'id' => $id, 'code' => $code, 'amount' => $amount, 'expiryDate' => $expiryDate]);
                }
        } 
            $this->view->render('admin/updateCoupons');
    }
    

    public function addcoupons() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = trim($_POST['code']);
            $amount = trim($_POST['amount']);
            $expiryDate = trim($_POST['expiry_date']);
            $errors = [];

            if (empty($code)) {
                $errors['code'] = 'Mã giảm giá không được để trống.';
            }
            if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
                $errors['amount'] = 'Số tiền giảm phải là một số dương.';
            }
            if (empty($expiryDate)) {
                $errors['expiry_date'] = 'Ngày hết hạn không được để trống.';
            } else {
                $currentDate = new DateTime();
                $expiryDateObj = new DateTime($expiryDate);
                $minimumDate = $currentDate->add(new DateInterval('P2M')); 
                
                if ($expiryDateObj <= $minimumDate) {
                    $errors['expiry_date'] = 'Ngày hết hạn phải lớn hơn ít nhất 2 tháng từ ngày hiện tại.';
                }
            }
            if (empty($errors)) {
                $this->DcodeDao->addDiscountCode($code, $amount, $expiryDate);
                $this->view->redirect('admin/index');
            }else{
            $this->view->render('admin/addCoupons', ['errors' => $errors]);
            }
        } 
            $this->view->render('admin/addCoupons');
    }
    


}

    

