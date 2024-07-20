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
    <link rel="stylesheet" href="../du-an-mau/public/css/formal.css">
</head>
<body>
<div class="container">
        <header>
            <nav>
                <ul class="keoDeAn">
                    <li class="rieng0"> <a href="#">
                            <img src="pic/logo.webp" alt="" class="logo">
                        </a></li>
                    <li class="rieng rieng1"><a href="home">Trang chủ</a></li>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <li class="rieng"><a href="user/login">Đăng Nhập</a></li>
                    <li class="rieng"><a href="admin">Admin</a></li>
                    <li class="rieng"><a href="user/logout">Đăng Xuất</a></li>
                    <li class="rieng"><a href="index.php?url=cart/viewCart">Cart</a></li>
                </ul>

                <ul class="dropdown">
                    <li class="rieng rieng1"><a href="#">Trang chủ</a></li>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <li class="rieng"><a href="user/login">Đăng Nhập</a></li>
                    <li class="rieng"><a href="user/logout">Đăng Xuất</a></li>
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
                                <th></th>
                            </tr>
                            <?php foreach ($cart as $key => $item): ?>
                                <tr>
                                    <td><img src="<?php echo $item['product_img']; ?>" alt="<?php echo $item['product_name']; ?>" class="cart-item-image"></td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo number_format($item['product_price']); ?>đ</td>
                                    <td><input type="number" name="cart[<?php echo $key; ?>][quantity]" value="<?php echo $item['quantity']; ?>" min="1"></td>
                                    <td><?php echo number_format($item['product_price'] * $item['quantity']); ?>đ</td>
                                    <td><input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>"></td>
                                    <td><a href="index.php?url=cart/removeFromCart/<?php echo $item['product_id']; ?>">Xóa</a></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4"><strong>Tổng cộng</strong></td>
                                <td><strong><?php echo number_format($totalAmount); ?>đ</strong></td>
                                <td></td>
                            </tr>
                        </table>
                        <button type="submit">Cập nhật giỏ hàng</button>
                    </form> 
                    <a href="index.php?url=order/checkout"><button>Thanh Toán</button></a>
                <?php else: ?>
                    <p>Giỏ hàng của bạn đang trống.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
</body>
</html>
