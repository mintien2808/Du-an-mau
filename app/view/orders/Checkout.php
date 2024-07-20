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
        <label for="shipping_address">Địa chỉ giao hàng:</label><br>
        <textarea name="shipping_address" id="shipping_address" required></textarea><br><br>
        <label for="user_name">Tên Người Nhận:</label>
        <input type="text" name='user_name' value='<?php echo $_SESSION['user']['username']?>'><br>
        
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


        <label for="order_info">Thanh Toán</label><br>
        <select name="order_info" id="order_info">
            <option value="Thanh toán qua MoMo">Thanh toán qua MoMo</option>
            <option value="Thanh toán qua MoMo">Không có </option>
        </select><br><br>
        
        <button type="submit" name='payUrl'>Thanh Toán</button>
    </form>
</div>
<?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
</body>
</html>
