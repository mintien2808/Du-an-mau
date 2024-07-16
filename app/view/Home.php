<?php include_once('include/header.php'); ?>

<section class="anh">
    <video width="1300" src="img/3196344-uhd_3840_2160_25fps.mp4" autoplay muted></video>
</section>

<div class="content">
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

    <br>

    <h1>Sản Phẩm</h1>
    <div class="sanPham">
        <ul>
            <?php 
            $count = 0; 
            foreach ($products as $product): ?>
                <?php if (isset($selectedCategory) && $product['category_id'] == $selectedCategory): ?>
                    <li class="sanPham">
                        <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="" class="to-ra"></a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['price']; ?>đ</p>
                        <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><button>Mua</button></a>
                    </li>
                    <?php 
                    $count++;
                    if ($count % 5 == 0) { 
                        echo '</ul><ul>';
                    }
                    ?>
                <?php else: ?>
                    <li class="sanPham">
                        <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="" class="to-ra"></a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['price']; ?>đ</p>
                        <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><button>Mua</button></a>
                    </li>
                    <?php 
                    $count++;
                    if ($count % 5 == 0) { 
                        echo '</ul><ul>';
                    }
                    ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php include_once('include/footer.php'); ?>
