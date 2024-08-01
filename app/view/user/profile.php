<?php
include_once('app/view/include/header.php');
$user_id = $_SESSION['user']['id'];
?>

<div class="user-profile">
    <h1>Thông Tin Người Dùng</h1>
    <div class="profile-info">
        <img src="../du-an-mau/<?php echo $user['img']; ?>" alt="<?php echo $user['img']; ?>">
        <p><strong>Tên:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo $user['phone']; ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo $user['address']; ?></p> 
        <br>
        <button onclick="showEditForm()">Chỉnh sửa thông tin</button>
    </div>

    <div class="edit-profile-form" style="display: none;">
        <h2>Chỉnh sửa thông tin</h2>
        <form action="index.php?url=user/updateProfile" method="POST" enctype="multipart/form-data">
            <input type="file" name="img">
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
            <input type="text" name="address" value="<?php echo $user['address']; ?>" required>
            <button type="submit">Cập nhật</button>
            <button type="button" onclick="hideEditForm()">Hủy</button>
        </form>
    </div>

    <div class="order-history">
        <h2>Đơn Hàng Đã Mua</h2>
        <?php if (!empty($orders)): ?>
            <ul>
                <?php foreach ($orders as $order): ?>
                    <li>
                        <p><strong>Mã đơn hàng:</strong> <?php echo $order['id']; ?></p>
                        <p><strong>Ngày đặt:</strong> <?php echo $order['order_date']; ?></p>
                        <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount']); ?>đ</p>
                        <h5>Sản phẩm trong đơn hàng:</h5>
                        <ul>
                            <?php foreach ($order['items'] as $item): ?>
                                <li>
                                    <p><strong>Tên sản phẩm:</strong> <?php echo $item['product_name']; ?></p>
                                    <p><strong>Số lượng:</strong> <?php echo $item['quantity']; ?></p>
                                    <p><strong>Giá:</strong> <?php echo number_format($item['product_price']); ?>đ</p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <button onclick="reorder(<?php echo $order['id']; ?>)">Đặt lại đơn hàng này</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Bạn chưa có đơn hàng nào.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function showEditForm() {
        document.querySelector('.edit-profile-form').style.display = 'block';
        document.querySelector('.profile-info').style.display = 'none';
    }

    function hideEditForm() {
        document.querySelector('.edit-profile-form').style.display = 'none';
        document.querySelector('.profile-info').style.display = 'block';
    }

    function reorder(orderId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?url=order/reorder', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    if (response.success) {
                        window.location.href = 'index.php?url=cart/viewCart';
                    }
                } else {
                    alert('Failed to reorder. Please try again.');
                }
            }
        };
        xhr.send('order_id=' + encodeURIComponent(orderId));
    }
</script>

<?php include_once('app/view/include/footer.php'); ?>
