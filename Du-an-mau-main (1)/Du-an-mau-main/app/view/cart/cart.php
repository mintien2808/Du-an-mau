<?php include_once('include/header.php'); ?>

<div class="content">
    <h2>Giỏ Hàng Của Bạn</h2>
    <div class="cart-items">
        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                    <th></th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="cart-item-image"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo number_format($item['price']); ?>đ</td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price'] * $item['quantity']); ?>đ</td>
                        <td><a href="index.php?url=Product/removeFromCart/<?php echo $item['id']; ?>">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><strong>Tổng cộng</strong></td>
                    <td><strong><?php echo number_format($totalAmount); ?>đ</strong></td>
                    <td></td>
                </tr>
            </table>
            <a href="index.php?url=Product/checkout"><button>Thanh Toán</button></a>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once('include/footer.php'); ?>
