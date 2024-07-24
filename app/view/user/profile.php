<?php include_once('../du-an-mau/app/view/include/header.php'); ?>
<div class="user-detail">
    <h1><?php echo $user['username']; ?></h1>
    <div class="user-image">
        <img src="<?php echo $user['img']; ?>" alt="">
    </div>
    
    <div class="user-info">
        <p>Giá: <?php echo $user['price']; ?>đ</p>
        <p><?php echo $user['description']; ?></p>
        <button onclick="addToCart(<?php echo $user['id']; ?>, '<?php echo $user['username']; ?>', <?php echo $user['price']; ?>, '<?php echo $user['img']; ?>')">Add to Cart</button>
        <a href="index.php?url=home"><button>Quay về trang mua</button></a>
    </div>
</div>
<?php include_once('../du-an-mau/app/view/include/footer.php'); ?>