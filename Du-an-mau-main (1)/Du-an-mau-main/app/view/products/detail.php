<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/header.php'); ?>

<div class="product-detail">
    <h1><?php echo $product['name']; ?></h1>
    <div class="product-image">
        <img src="<?php echo $product['img']; ?>" alt="">
    </div>
    
    <div class="product-info">
        <p>Giá: <?php echo $product['price']; ?>đ</p>
        <p><?php echo $product['description']; ?></p>
        <a href="index.php?url=Product/addtoCart/<?php echo $product['id']; ?>"><button>Mua</button></a>
    </div>
</div>
<?php include_once('/xampp/htdocs/php/du-an-mau/app/view/include/footer.php'); ?>