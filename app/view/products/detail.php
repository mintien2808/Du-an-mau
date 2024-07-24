<?php include_once('../du-an-mau/app/view/include/header.php'); ?>

<div class="product-detail">
    <div class="product-image">
        <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
    </div>

    <div class="product-info">
        <h1><?php echo $product['name']; ?></h1>
        <p>Giá: <?php echo number_format($product['price']); ?>đ</p>
        <p><?php echo $product['description']; ?></p>
        <button id="addButton_<?php echo $product['id']; ?>" onclick="showQuantityInput(<?php echo $product['id']; ?>)">Add to Cart</button>
        <div id="quantityInput_<?php echo $product['id']; ?>" class="quantity-input" style="display: none;">
            <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity" value="1" min="1">
            <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>, '<?php echo $product['img']; ?>')">Add</button>
            <button onclick="hideQuantityInput(<?php echo $product['id']; ?>)">Cancel</button>
        </div>
        <a href="index.php?url=home"><button>Quay về trang mua</button></a>
    </div>
</div>

<div class="related-products">
    <h2>Sản phẩm cùng danh mục</h2>
    <div class="product-list">
        <?php foreach ($relatedProducts as $relatedProduct): ?>
            <div class="product-item">
                <a href="index.php?url=product/detail/<?php echo $relatedProduct['id']; ?>">
                    <img src="<?php echo $relatedProduct['img']; ?>" alt="<?php echo $relatedProduct['name']; ?>">
                    <h3><?php echo $relatedProduct['name']; ?></h3>
                    <p>Giá: <?php echo number_format($relatedProduct['price']); ?>đ</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="product-reviews">
<?php if (isset($_SESSION['user'])): ?>
    <div class="add-review">
        <h4>Add your review</h4>
        <textarea id="review-comment" placeholder="Leave a comment"></textarea>
        <input type="number" id="review-rating" min="1" max="5" placeholder="Rating (1-5)">
        <button onclick="submitReview(<?php echo $product['id']; ?>)">Submit Review</button>
    </div>
    <?php else: ?>
        <p>Please <a href="User/login">login</a> to add a review.</p>
    <?php endif; ?>
    <h3>Bình Luận</h3>
    <div id="reviews-container">
        <?php
        if (isset($reviews)) {
            foreach ($reviews as $review) {
                echo "<div class='review-item'>";
                echo "<p><strong>{$review['username']}</strong> (Rating: {$review['rating']}/5)</p>";
                echo "<p>{$review['comment']}</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }
        ?>
    </div>
</div>



<script src="../du-an-mau/public/js/prod.js"></script>
<?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
