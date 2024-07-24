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
                <button onclick="submitReview(<?php echo $product['id']; ?>,'<?php echo $_SESSION['user']['username']; ?>',<?php echo $_SESSION['user']['id']; ?>)">Submit Review</button>
            </div>
        <?php else: ?>
            <p>Please <a href="User/login">login</a> to add a review.</p>
        <?php endif; ?>
        <h3>Bình Luận</h3>
        <div id="reviews-container">
        <?php
        if (isset($reviews) && !empty($reviews)) {
            foreach ($reviews as $review) {
                echo "<div class='review-item' id='review-{$review['id']}'>
                        <p class='username'><strong>{$review['username']}</strong> <span class='rating'>(Rating: {$review['rating']}/5)</span></p>
                        <p class='comment'>{$review['comment']}</p>
                        <p class='created-at'>{$review['created_at']}</p>";

                if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $review['user_id']) {
                    echo "<button onclick='showEditForm({$review['id']})'>Chỉnh sửa</button>";
                    echo "<a href='index.php?url=review/deleteReview&id={$review['id']}&product_id={$product['id']}'
                    class='button-like' onclick='return confirm(\"Are you sure you want to delete this review?\")'>Delete</a>";
                    echo "<div id='edit-form-{$review['id']}' class='edit-form' style='display: none;'>
                            <textarea id='edit-comment-{$review['id']}'>{$review['comment']}</textarea>
                            <input type='number' id='edit-rating-{$review['id']}' value='{$review['rating']}' min='1' max='5'>
                            <button onclick='submitEdit({$review['id']})'>Cập nhật</button>
                            <button onclick='hideEditForm({$review['id']})'>Hủy</button>
                          </div>";     
                }

                echo "</div>";
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }
        ?>
    </div>

</div>

<script>
    const isUserLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;
</script>
<script src="../du-an-mau/public/js/prod.js"></script>
<?php include_once('../du-an-mau/app/view/include/footer.php'); ?>
