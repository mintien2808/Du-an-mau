<?php include_once('include/header.php'); 
?>
<div class="content">
    <h2>Danh Mục</h2>
    <main>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li class="anh">
                    <a href="index.php?url=product/showByCategory/<?php echo $category['id']; ?>" class="category">
                        <img src="<?php echo $category['image']; ?>" alt="">
                    </a>
                    <h5><?php echo $category['name']; ?></h5>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <br>

    <h1>Sản Phẩm</h1>
    <div class="sanPham">
        <ul>
            <?php foreach ($products as $product): ?>
                <li class="sanPham">
                    <a href="sanPham.html"><img src="<?php echo $product['image']; ?>" alt="" class="to-ra"></a>
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo $product['price']; ?>đ</p>
                    <a href="sanPham.html"><button>Mua</button></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php include_once('include/footer.php'); ?>
