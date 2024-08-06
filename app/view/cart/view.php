<?php
$totalAmount = 0;
if (!empty($cart)) {
    foreach ($cart as $item) {
        $totalAmount += $item['product_price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/formal.css">
</head>
<style>
    button.capNhap {
        background-color: #4CAF50; 
        border: none; 
        color: white; 
        padding: 15px 32px;
        text-align: center; 
        text-decoration: none; 
        display: inline-block; 
        font-size: 16px; 
        margin: 4px 2px;
        cursor: pointer; 
        border-radius: 4px; 
        transition: background-color 0.3s ease;
    }

    button.capNhap:hover {
        background-color: #45a049; 
    }

    a button.capNhap {
        margin: 4px 2px;
        cursor: pointer;
    }

    ul.main {
        width: 150px;
        margin-left: 210px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .cart-item-image {
        width: 140px;
        height: 140px;
    }
</style>
<body>
<div class="container">
<header>
    <nav>
        <ul class="nav-menu">
            <li class="nav-item logo-item"><a href="#"><img src="pic/logo.webp" alt="" class="logo"></a></li>
            <li class="nav-item home-item"><a href="home">Trang chủ</a></li>
            <li class="nav-item"><a href="index.php?url=cart/viewCart">Cart</a></li>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                echo '<li class="nav-item"><a href="admin">Admin</a></li>';
            } ?>
            <li class="nav-item"><a href="introduce">About Us</a></li>
            <?php if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
                echo '<li class="nav-item"><a href="user/login">Đăng Nhập</a></li>';
            } else {
                echo '<li class="nav-item"><a href="index.php?url=user/profile/'.$_SESSION['user']['id'].'">Thông Tin người dùng</a></li>';
                echo '<li class="nav-item"><a href="user/logout">Đăng Xuất</a></li>';
            } ?>
        </ul>
    </nav>
</header>
        <div class="content">
            <h2>Giỏ Hàng Của Bạn</h2>
            <div class="cart-items">
                <?php if (!empty($cart)): ?>
                    <form method="POST" action="index.php?url=cart/updateCart">
                        <table>
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                
                            </tr>
                            <?php foreach ($cart as $key => $item): ?>
                                <tr>
                                    <td><img src="<?php echo $item['product_img']; ?>" alt="<?php echo $item['product_name']; ?>" class="cart-item-image"></td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo number_format($item['product_price']); ?>đ</td>
                                    <td><input type="number" name="cart[<?php echo $key; ?>][quantity]" value="<?php echo $item['quantity']; ?>" min="1"></td>
                                    <td><?php echo number_format($item['product_price'] * $item['quantity']); ?>đ</td>
                                    <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
                                    <td><a href="index.php?url=cart/removeFromCart/<?php echo $item['product_id']; ?>">Xóa</a></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4"><strong>Tổng cộng</strong></td>
                                <td><strong><?php echo number_format($totalAmount); ?>đ</strong></td>
                            </tr>
                        </table>
                        <button class="capNhap" type="submit">Cập nhật giỏ hàng</button>
                    </form> 
                    <a href="index.php?url=order/checkout"><button class="capNhap">Thanh Toán</button></a>
                <?php else: ?>
                    <p>Giỏ hàng của bạn đang trống.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
</body>
</html>
