<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../du-an-mau/public/css/formal.css">
</head>
<body>

<div class="container">
    <header>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item logo-item"><a href="home"><img src="public/img/logo.webp" alt="home" class="logo"></a></li>
                <li class="nav-item home-item"><a href="home">Trang chủ</a></li>
                <li class="nav-item"><a href="index.php?url=cart/viewCart">Cart</a></li>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                    echo '<li class="nav-item"><a href="admin">Admin</a></li>';
                } ?>
                <li class="nav-item"><a href="introduce">About Us</a></li>
                <?php if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
                    echo '<li class="nav-item"><a href="user/login">Đăng Nhập</a></li>';
                } else {
                    echo '<li class="nav-item"><a href="index.php?url=user/profile/'.$_SESSION['user']['id'].'">Thông Tin người dùng</a></li>';
                    echo '<li class="nav-item"><a href="user/logout">Đăng Xuất</a></li>';
                } ?>
            </ul>
        </nav>
    </header>

    <div class="anh">
        <video autoplay>
            <source src="public/img/3196344-uhd_3840_2160_25fps.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

        <h2>Danh Mục</h2>
        <form action="index.php" method="GET" class="search-form">
            <input type="hidden" name="url" value="Product/search">
            <input type="text" name="search" class="search-input" placeholder="Tìm sản phẩm..." required>
            <button type="submit" class="search-button">Tìm kiếm</button>
        </form>


    <main>
        <ul class="category-list">
            <?php foreach ($categories as $category): ?>
                <li class="category-item">
                    <a href="index.php?url=Product/showByCategory/<?php echo $category['id']; ?>" class="category-link">
                        <img src="<?php echo $category['img']; ?>" alt="Category Image">
                    </a>
                    <h5 class="category-name"><?php echo $category['name']; ?></h5>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <div class="prd-container">
    <h2>Sản Phẩm</h2>
    <?php if (!empty($products)): ?>
        <ul class="prd-grid">
            <?php foreach ($products as $product): ?>
                <li class="prd-card">
                    <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>" class="prd-link">
                        <img src="<?php echo $product['img']; ?>" alt="Product Image" class="prd-image">
                    </a>
                    <h3 class="prd-title"><?php echo $product['name']; ?></h3>
                    <p class="prd-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                    <button id="addButton_<?php echo $product['id']; ?>" onclick="showQuantityInput(<?php echo $product['id']; ?>)" class="btn-add">Thêm</button>
                    <div id="quantityInput_<?php echo $product['id']; ?>" class="quantity-controls hidden">
                        <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity" min="1" value="1" class="quantity-field">
                        <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>, '<?php echo $product['img']; ?>')" class="btn-add-to-cart">Add to Cart</button>
                        <button type="button" onclick="hideQuantityInput(<?php echo $product['id']; ?>)" class="btn-cancel">Hủy</button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="no-products">Hiện tại không có sản phẩm nào.</p>
    <?php endif; ?>
</div>




<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href="#"><img src="public/img/logo.webp" alt="logo"></a>
        </div>

        <div class="footer-icons">
            <ul>
                <li><a href="#"><img src="public/img/ins.png" alt="Icon 1"></a></li>
                <li><a href="#"><img src="public/img/face.webp" alt="Icon 2"></a></li>
                <li><a href="#"><img src="public/img/X.png" alt="Icon 3"></a></li>
                <li><a href="#"><img src="public/img/tele.webp" alt="Icon 4"></a></li>
            </ul>
        </div>

        <div class="footer-links">
            <div class="footer-info">
                <p>Thương hiệu thời trang MARC - CÔNG TY CỔ PHẦN SẢN XUẤT THƯƠNG MẠI NÉT VIỆT
                    Địa chỉ: Tầng 15.06 Tòa nhà Văn phòng Golden King, Số 15 Nguyễn Lương Bằng, Phường Tân Phú,
                    Quận 7, Tp. HCM</p>
                <p>Chính sách bảo mật | Các điều khoản và điều kiện</p>
            </div>

            <div class="footer-section">
                <h2>Về chúng tôi</h2>
                <ul>
                    <li><a href="#">Giới thiệu MARC</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h2>Hỗ trợ khách hàng</h2>
                <ul>
                    <li><a href="#">Liên hệ đến MARC</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                    <li><a href="#">Hướng dẫn tạo tài khoản</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h2>Liên lạc</h2>
                <p>Đặt hàng trực tuyến (8h-21h) 1900 636942</p>
            </div>
        </div>
    </div>
</footer>

<script>const isUserLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;</script>
<script src="../du-an-mau/public/js/prod.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>