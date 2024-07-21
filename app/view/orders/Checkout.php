<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../du-an-mau/public/css/formal.css">
</head>
<body>
<div class="content">
    <h2>Thông Tin Giao Hàng</h2>
    <form action="index.php?url=online/online_checkout" method="POST">
        <label for="user_name">Tên Người Nhận:</label><br>
        <input type="text" name="user_name" value="<?php echo $_SESSION['user']['username']; ?>" ><br><br>
        <label for="shipping_address">Địa chỉ giao hàng:</label><br>
        <textarea name="shipping_address" id="shipping_address" ></textarea><br><br>
        <label for="phone">Số điện thoại:</label><br>
        <input type="text" name="phone" id="phone" ><br><br>

        <h2>Sản Phẩm Đã Đặt</h2>
        <table>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Thành Tiền</th>
            </tr>
            <?php
            $cart = $_SESSION['cart'] ?? [];
            $totalAmount = 0;
            foreach ($cart as $item) {
                $itemTotal = $item['product_price'] * $item['quantity'];
                $totalAmount += $itemTotal;
                echo "<tr>
                        <td>{$item['product_name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>{$item['product_price']}</td>
                        <td>{$itemTotal}</td>
                      </tr>";
            }
            ?>
            <tr>
                <td colspan="3">Tổng Cộng</td>
                <td><?php echo $totalAmount; ?></td>
            </tr>
        </table>
        <input type="hidden" name="order_info" id="order_info" value="Thanh toán qua MoMo"><br><br>
        <input type="hidden" name="amount" id="amount" value="<?php echo $totalAmount; ?>"><br><br>
        <button type="submit" name="payUrl">Thanh Toán Qua MoMo</button>
    </form>
</div>
<?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
</body>
</html>
