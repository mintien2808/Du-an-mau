
<?php var_dump($_SESSION['user']['username']);
var_dump($_SESSION['cart']);  ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/formal.css">
    <script>
        function showQuantityInput(productId) {
            document.getElementById('addButton_' + productId).style.display = 'none';
            document.getElementById('quantityInput_' + productId).style.display = 'block';
        }

        function hideQuantityInput(productId) {
            document.getElementById('addButton_' + productId).style.display = 'block';
            document.getElementById('quantityInput_' + productId).style.display = 'none';
        }

        function addToCart(productId, productName, productPrice, productImg) {
    if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
        window.location.href = 'User/login';
        return; 
    }

    const quantity = document.getElementById('quantity_' + productId).value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?url=Cart/addToCart', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) { 
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                hideQuantityInput(productId);
            } else {
                alert('Failed to add to cart. Please try again.'); 
            }
        }
    };

    const data = 'product_id=' + encodeURIComponent(productId) +
                 '&quantity=' + encodeURIComponent(quantity) +
                 '&product_name=' + encodeURIComponent(productName) +
                 '&product_price=' + encodeURIComponent(productPrice) +
                 '&product_img=' + encodeURIComponent(productImg);

    xhr.send(data);
}
    </script>
</head>
<body>
<div class="container">
        <header>
            <nav>
                <ul class="keoDeAn">
                    <li class="rieng0"> <a href="#">
                            <img src="pic/logo.webp" alt="" class="logo">
                        </a></li>
                    <li class="rieng rieng1"><a href="home">Trang chủ</a></li>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <li class="rieng"><a href="user/login">Đăng Nhập</a></li>
                    <li class="rieng"><a href="admin">Admin</a></li>
                    <li class="rieng"><a href="user/logout">Đăng Xuất</a></li>
                    <li class="rieng"><a href="index.php?url=cart/viewCart">Cart</a></li>
                </ul>

                <ul class="dropdown">
                    <li class="rieng rieng1"><a href="#">Trang chủ</a></li>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <li class="rieng"><a href="user/login">Đăng Nhập</a></li>
                    <li class="rieng"><a href="user/logout">Đăng Xuất</a></li>
                </ul>
            </nav>
        </header>
<section class="anh">
    <video width="1300" src="img/3196344-uhd_3840_2160_25fps.mp4" autoplay muted></video>
</section>

<h2>Danh Mục</h2>
    <main>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li class="anh">
                    <a href="index.php?url=Product/showByCategory/<?php echo $category['id']; ?>" class="category">
                        <img src="<?php echo $category['img']; ?>" alt="">
                    </a>
                    <h5><?php echo $category['name']; ?></h5>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    <div class="content">
        <h1>Sản Phẩm</h1>
        <div class="sanPham">
            <ul>
                <?php 
                $count = 0; 
                foreach ($products as $product): ?>
                    <li class="sanPham">
                        <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="" class="to-ra"></a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['price']; ?>đ</p>
                        <button id="addButton_<?php echo $product['id']; ?>" onclick="showQuantityInput(<?php echo $product['id']; ?>)">Thêm</button>
                        <div id="quantityInput_<?php echo $product['id']; ?>" style="display:none;">
                            <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity" min="1" value="1">
                            <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>, '<?php echo $product['img']; ?>')">Add to Cart</button>
                            <button type="button" onclick="hideQuantityInput(<?php echo $product['id']; ?>)">Hủy</button>
                        </div>
                    </li>
                    <?php 
                    $count++;
                    if ($count % 5 == 0) { 
                        echo '</ul><ul>';
                    }
                    ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
