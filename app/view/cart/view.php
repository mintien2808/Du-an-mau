<?php
$totalAmount = 0;
if (!empty($cart)) {
    foreach ($cart as $item) {
        $totalAmount += $item['product_price'] * $item['quantity'];
    }
}
?>
<?php include_once('app/view/include/header.php'); ?>
<div class="container">
        <div class="content">
            <h2>Giỏ Hàng Của Bạn</h2>
            <div class="cart-items">
                <?php if (!empty($cart)): ?>
                    <form method="POST" action="index.php?url=cart/updateCart">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $key => $item): ?>
                                    <tr>
                                        <td><img src="<?php echo $item['product_img']; ?>" alt="<?php echo $item['product_name']; ?>" class="cart-item-image"></td>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td><?php echo number_format($item['product_price']); ?>đ</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="submit">&minus;</button>
                                                </div>
                                                <input type="text" class="form-control text-center quantity-amount" min="1" value="<?php echo $item['quantity']; ?>" aria-label="Quantity" name="cart[<?php echo $key; ?>][quantity]" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="submit">&plus;</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo number_format($item['product_price'] * $item['quantity']); ?>đ</td>
                                        <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
                                        <td><a href="index.php?url=cart/removeFromCart/<?php echo $item['product_id']; ?>" class="remove-btn">Xóa</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4"><strong>Tổng cộng</strong></td>
                                    <td><strong><?php echo number_format($totalAmount); ?>đ</strong></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </form> 
                    <a href="index.php?url=order/checkout"><button class="checkout-btn">Thanh Toán</button></a>
                <?php else: ?>
                    <div class="empty-cart">
                        <img src="public/img/cartempty.jpg" alt="Nocart" class='empty-cart-img'>
                        <p>Giỏ hàng của bạn đang trống.</p>
                        <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm.</p>
                        <a href="home" class="btn btn-primary">Xem Sản Phẩm</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php include_once('app/view/include/footer.php'); ?>
        <script src="public/js/admin.js"></script>
</body>
</html>
