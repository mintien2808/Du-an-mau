<?php
if (empty($_SESSION['cart'])) {
    header("Location: index.php?url=cart/viewCart");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../du-an-mau/public/css/formal.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        .content {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 20px;
            color: #4CAF50;
            font-size: 1.5em;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:last-child td {
            font-weight: bold;
        }

        button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .back {
            background-color: red;
        }

        .back:hover {
            background-color: rgb(180, 29, 29);
        }

        @media (max-width: 600px) {
            .content {
                padding: 15px;
            }

            table th, table td {
                padding: 8px;
            }

            input[type="text"], textarea {
                padding: 8px;
            }

            button {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<div class="content">
    <h2>Thông Tin Giao Hàng</h2>
    <form id="checkoutForm" action="index.php?url=online/online_checkout" method="POST">
        <input type="hidden" name="user_name" value="<?php echo $_SESSION['user']['username']; ?>" required><br><br>
        <label for="shipping_address">Địa chỉ giao hàng:</label><br>
        <textarea name="shipping_address" id="shipping_address" required></textarea><br><br>
        <label for="phone">Số điện thoại:</label><br>
        <input type="text" name="phone" id="phone" required><br><br>
        <label for="discount_code">Mã Giảm Giá:</label>
        <select name="discount_code" id="discount_code">
            <option value="">-- Chọn Mã Giảm Giá --</option>
            <?php foreach ($discountCodes as $code): ?>
                <option value="<?php echo $code['code']; ?>"><?php echo $code['code']; ?> - <?php echo $code['amount']; ?>VND</option>
            <?php endforeach; ?>
        </select><br><br>


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
        <button type="button" onclick="goToCart()" class="back">Quay về cart</button>
    </form>
</div>
<script src="../du-an-mau/public/js/checkout.js"></script>
</body>
</html>
