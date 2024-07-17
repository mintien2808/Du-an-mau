<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/header.php');?>
<div class="content">
    <h2>Danh sách Người dùng</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Ảnh đại diện</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['img']; ?></td>
                <td>
                    <a href="index.php?url=admin/ChangeUserInfo/<?php echo $user['id']; ?>">Sửa</a>
                    <a href="index.php?url=admin/DeleteUser/<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin/adduser">Thêm người dùng mới</a>
</div>

<div class="content">
    <h2>Danh sách sản phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Ảnh đại diện</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['img']; ?></td>
                <td>
                    <a href="index.php?url=admin/UpdateProduct/<?php echo $product['id']; ?>">Sửa</a>
                    <a href="index.php?url=admin/DeleteProduct/<?php echo $product['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin/Addproduct">Thêm người dùng mới</a>
</div>

<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/footer.php'); ?>
