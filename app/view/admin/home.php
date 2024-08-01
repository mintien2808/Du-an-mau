<?php include_once('app/view/include/header.php');?>

<!-- DANH SACH USER-->
<div class="content user-list">
    <h2 class="section-title">Danh sách Người dùng</h2>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th class="table-header">ID</th>
                <th class="table-header">Tên người dùng</th>
                <th class="table-header">Email</th>
                <th class="table-header">Ảnh đại diện</th>
                <th class="table-header">Số Điện thoại</th>
                <th class="table-header">Mật Khẩu</th>
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
                <td class="table-cell"><?php echo $user['password']; ?></td>
                <td class="table-cell"><?php echo $user['address']; ?></td>
                <td class="table-cell"><?php echo $user['role']; ?></td>
                <td class="table-cell">
                    <button type="button" onclick="showEditForm(<?php echo $user['id']; ?>)">Chỉnh sửa thông tin</button>
                    <a class="action-link" href="index.php?url=admin/DeleteUser/<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tbody class="table-body edit-admin-show" style="display: none;">
            <?php foreach ($users as $user): ?>
                <tr class="table-row edit-row-<?php echo $user['id']; ?>" style="display: none;">
                    <form action="index.php?url=admin/ChangeUserInfo/<?php echo $user['id']; ?>" method="post">
                        <td class="table-cell"><?php echo $user['id']; ?></td>
                        <td class="table-cell"><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
                        <td class="table-cell"><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
                        <td class="table-cell"><input type="text" name="img" value="<?php echo $user['img']; ?>"></td>
                        <td class="table-cell"><input type="number" name="phone" value="<?php echo $user['phone']; ?>"></td>
                        <td class="table-cell"><input type="password" name="password" value="<?php echo $user['password']; ?>"></td>
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

<div class="content product-list">
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

<div class="content category-list">
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

<div class="content order-list">
    <h2 class="section-title">Danh sách Orders</h2>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th class="table-header">ID</th>
                <th class="table-header">ID người dùng</th>
                <th class="table-header">Tổng Tiền</th>
                <th class="table-header">Hành động</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php foreach ($orders as $order): ?>
            <tr class="table-row">
                <td class="table-cell"><?php echo $order['id']; ?></td>
                <td class="table-cell"><?php echo $order['user_id']; ?></td>
                <td class="table-cell"><?php echo $order['total_amount']; ?></td>
                <td class="table-cell">
                    <a class="action-link" href="index.php?url=admin/UpdateOrder/<?php echo $order['id']; ?>">Sửa</a>
                    <a class="action-link" href="index.php?url=admin/DeleteOrder/<?php echo $order['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="content order-list">
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
                    <a class="action-link" href="index.php?url=admin/UpdateOrder/<?php echo $review['id']; ?>">Sửa</a>
                    <a class="action-link" href="index.php?url=admin/DeleteOrder/<?php echo $review['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</script>

<?php include_once('app/view/include/footer.php');?>
