
<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') { ?>
    <?php include_once('app/view/include/header.php');?>
    <div class="container">
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
        <li class="nav-s">
            <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Người dùng</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Sản phẩm</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Danh mục</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Đơn hàng</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="coupons-tab" data-toggle="tab" href="#coupons" role="tab" aria-controls="coupons" aria-selected="false">Coupons</a>
        </li>
        <li class="nav-s">
            <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="stats" aria-selected="false">Thống kê</a>
        </li>
        </ul>

        <div class="tab-content">
        <div class="tab-pane fade show active tab-content" id="users" role="tabpanel" aria-labelledby="users-tab">
            <h2 class="section-title">Danh sách Người dùng</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">Tên người dùng</th>
                        <th class="table-header">Email</th>
                        <th class="table-header">Ảnh đại diện</th>
                        <th class="table-header">Số Điện thoại</th>
                        <th class="table-header">Địa Chỉ</th>
                        <th class="table-header">Role</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body admin-show">
                    <?php foreach ($users as $user): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $user['id']; ?></td>
                        <td class="table-cell"><?php echo $user['username']; ?></td>
                        <td class="table-cell"><?php echo $user['email']; ?></td>
                        <td class="table-cell"><img src="<?php echo $user['img']; ?>" alt="User Image" class="avatar-img"></td>
                        <td class="table-cell"><?php echo $user['phone']; ?></td>
                        <td class="table-cell"><?php echo $user['address']; ?></td>
                        <td class="table-cell"><?php echo $user['role']; ?></td>
                        <td class="table-cell">
                            <button type="button" class ="btn btn-warning" onclick="showEditForm(<?php echo $user['id']; ?>)">Sửa</button>
                            <a class="action-link" href="index.php?url=admin/DeleteUser/<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody class="table-body edit-admin-show" style="display: none;">
                    <?php foreach ($users as $user): ?>
                        <tr class="table-row edit-row-<?php echo $user['id']; ?>" style="display: none;">
                        <form action="index.php?url=admin/ChangeUserInfo/<?php echo $user['id']; ?>" method="post" enctype="multipart/form-data">
                                <td class="table-cell"><?php echo $user['id']; ?></td>
                                <td class="table-cell"><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
                                <td class="table-cell"><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
                                <td class="table-cell"><input type="file" name="image"></td>
                                <td class="table-cell"><input type="number" name="phone" value="<?php echo $user['phone']; ?>"></td>
                                <td class="table-cell"><input type="password" name="password"></td>
                                <td class="table-cell"><input type="text" name="address" value="<?php echo $user['address']; ?>"></td>
                                <td class="table-cell">
                                <select name="role">
                                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                </select>
                            </td>
                            <td class="table-cell">
                                <button type="submit">Lưu</button>
                                <button type="button" onclick="hideEditForm(<?php echo $user['id']; ?>)">Hủy</button>
                            </td>
                        </form>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="add-link" href="admin/adduser">Thêm người dùng mới</a>
        </div>

        <div class="tab-pane fade tab-content" id="products" role="tabpanel" aria-labelledby="products-tab">
            <h2 class="section-title">Danh sách sản phẩm</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">Tên sản phẩm</th>
                        <th class="table-header">Giá</th>
                        <th class="table-header">Số Lượng</th>
                        <th class="table-header">Ảnh đại diện</th>
                        <th class="table-header">Cate</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($products as $product): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $product['id']; ?></td>
                        <td class="table-cell"><?php echo $product['name']; ?></td>
                        <td class="table-cell"><?php echo $product['price']; ?></td>
                        <td class="table-cell"><?php echo $product['quantity']; ?></td>
                        <td class="table-cell"><img src="<?php echo $product['img']; ?>" alt="Product Image" class="product-img"></td>
                        <td class="table-cell"><?php echo $product['id_category']; ?></td>
                        <td class="table-cell">
                            <a class="action-link" href="index.php?url=admin/UpdateProduct/<?php echo $product['id']; ?>">Sửa</a>
                            <a class="action-link" href="index.php?url=admin/DeleteProduct/<?php echo $product['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="add-link" href="admin/Addproduct">Thêm sản phẩm mới</a>
        </div>

        <div class="tab-pane fade tab-content" id="categories" role="tabpanel" aria-labelledby="categories-tab">
            <h2 class="section-title">Danh sách danh mục</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">Tên danh mục</th>
                        <th class="table-header">Ảnh đại diện</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($categories as $category): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $category['id']; ?></td>
                        <td class="table-cell"><?php echo $category['name']; ?></td>
                        <td class="table-cell"><img src="<?php echo $category['img']; ?>" alt="Category Image" class="category-img"></td>
                        <td class="table-cell">
                            <a class="action-link" href="index.php?url=admin/UpdateCategory/<?php echo $category['id']; ?>">Sửa</a>
                            <a class="action-link" href="index.php?url=admin/DeleteCategory/<?php echo $category['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="add-link" href="admin/AddCategory">Thêm danh mục mới</a>
        </div>

        <div class="tab-pane fade tab-content" id="orders" role="tabpanel" aria-labelledby="orders-tab">
            <h2 class="section-title">Danh sách Orders</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">ID người dùng</th>
                        <th class="table-header">Tổng Tiền</th>
                        <th class="table-header">Ngày Tạo</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($orders as $order): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $order['id']; ?></td>
                        <td class="table-cell"><?php echo $order['user_id']; ?></td>
                        <td class="table-cell"><?php echo $order['total_amount']; ?></td>
                        <td class="table-cell"><?php echo $order['order_date']; ?></td>
                        <td class="table-cell">
                            <a class="action-link" href="index.php?url=admin/DeleteOrder/<?php echo $order['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2 class="section-title">Danh sách Chi Tiết</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">Hoá Đơn</th>
                        <th class="table-header">Sản Phẩm</th>
                        <th class="table-header">Người Nhận</th>
                        <th class="table-header">Số lượng</th>
                        <th class="table-header">Tổng Tiền Sản phẩm</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($orderdetail as $order2): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $order2['id']; ?></td>
                        <td class="table-cell"><?php echo $order2['order_id']; ?></td>
                        <td class="table-cell"><?php echo $order2['product_name']; ?></td>
                        <td class="table-cell"><?php echo $order2['user_name']; ?></td>
                        <td class="table-cell"><?php echo $order2['quantity']; ?></td>
                        <td class="table-cell"><?php echo $order2['total_price']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade tab-content" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
            <h2 class="section-title">Danh sách Reviews</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">ID người dùng</th>
                        <th class="table-header">Tên người dùng</th>
                        <th class="table-header">ID Sản Phẩm</th>
                        <th class="table-header">Rating</th>
                        <th class="table-header">Comment</th>
                        <th class="table-header">Ngày</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($reviews as $review): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $review['id']; ?></td>
                        <td class="table-cell"><?php echo $review['user_id']; ?></td>
                        <td class="table-cell"><?php echo $review['username']; ?></td>
                        <td class="table-cell"><?php echo $review['product_id']; ?></td>
                        <td class="table-cell"><?php echo $review['rating']; ?></td>
                        <td class="table-cell"><?php echo $review['comment']; ?></td>
                        <td class="table-cell"><?php echo $review['created_at']; ?></td>
                        <td class="table-cell">
                            <a class="action-link" href="index.php?url=admin/editReview/<?php echo $review['id']; ?>">Sửa</a>
                            <a class="action-link" href="index.php?url=admin/DeleteReview/<?php echo $review['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="add-link" href="admin/addReview">Thêm đánh giá mới</a>
        </div>

        <div class="tab-pane fade tab-content" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
            <h2 class="section-title">Danh sách Người dùng</h2>
            <table class="table">
                <thead class="table-head">
                    <tr>
                        <th class="table-header">ID</th>
                        <th class="table-header">Code</th>
                        <th class="table-header">Giá</th>
                        <th class="table-header">Hết Hạn</th>
                        <th class="table-header">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body admin-show">
                    <?php foreach ($coupons as $coupon): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo $coupon['id']; ?></td>
                        <td class="table-cell"><?php echo $coupon['code']; ?></td>
                        <td class="table-cell"><?php echo $coupon['amount']; ?></td>
                        <td class="table-cell"><?php echo $coupon['expiry_date']; ?></td>
                        <td class="table-cell">
                            <a class="action-link" href="index.php?url=admin/FixCouPons/<?php echo $coupon['id']; ?>">Sửa</a>
                            <a class="action-link" href="index.php?url=admin/DeleteCoupons/<?php echo $coupon['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa coupons này không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="add-link" href="admin/addcoupons">Thêm người dùng mới</a>
        </div>

        <div class="tab-pane fade tab-content" id="stats" role="tabpanel" aria-labelledby="stats-tab">
            <h2 class="section-title">Thống kê số lượng Đơn hàng theo tháng</h2>
            <canvas id="orderChart" width="400" height="200"></canvas>
            <canvas id="userChart" width="400" height="200"></canvas>
        </div>

        </div>
    </div>

    <script>
        function showEditForm(userId) {
            document.querySelectorAll('.admin-show').forEach(function(row) {
                row.style.display = 'none';
            });
            document.querySelector('.edit-admin-show').style.display = '';
            document.querySelector('.edit-row-' + userId).style.display = '';
        }

        function hideEditForm(userId) {
            document.querySelectorAll('.admin-show').forEach(function(row) {
                row.style.display = '';
            });
            document.querySelector('.edit-admin-show').style.display = 'none';
            document.querySelector('.edit-row-' + userId).style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            var tabs = document.querySelectorAll('.nav-link');
            var contents = document.querySelectorAll('.tab-content');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function(event) {
                    event.preventDefault();
                    var target = document.querySelector(tab.getAttribute('href'));

                    
                    tabs.forEach(function(t) { t.classList.remove('active'); });
                    contents.forEach(function(c) { c.classList.remove('show'); c.classList.remove('active'); });

                    
                    tab.classList.add('active');
                    target.classList.add('active');
                    target.classList.add('show');
                });
            });
        });
    </script>
    <?php
        echo "<script>
            var registrationData = {
                labels: " . json_encode(array_column($orderDetails, 'order_date')) . ",
                data: " . json_encode(array_column($orderDetails, 'quantity')) . ",
                totalAmount: " . json_encode(array_column($orders, 'total_amount')) . "
            };

        </script>";
    ?>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('orderChart').getContext('2d');
                var registrationChart = new Chart(ctx, {
                    type: 'line', 
                    data: {
                        labels: registrationData.labels,
                        datasets: [{
                            label: 'Số lượng Đơn hàng',
                            data: registrationData.data,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

<?php include_once('app/view/include/footer.php');?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
    
<?php
} else {
    header('location:404.html');
}
?>

