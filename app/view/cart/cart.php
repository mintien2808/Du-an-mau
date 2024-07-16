<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/header.php'); ?>

<div class="cart-container">
    <h1>Giỏ Hàng</h1>
    <table>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
            <th>Xóa</th>
        </tr>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?>đ</td>
                    <td><?php echo $item['quantity'] * $item['price']; ?>đ</td>
                    <td><a href="index.php?url=Product/removeFromCart/<?php echo $item['id']; ?>">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Giỏ hàng trống</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/footer.php'); ?>
