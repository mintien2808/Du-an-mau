// product.js

function showQuantityInput(productId) {
    document.getElementById('addButton_' + productId).style.display = 'none';
    document.getElementById('quantityInput_' + productId).style.display = 'flex';
}

function hideQuantityInput(productId) {
    document.getElementById('addButton_' + productId).style.display = 'block';
    document.getElementById('quantityInput_' + productId).style.display = 'none';
}

function addToCart(productId, productName, productPrice, productImg) {
    if (!isUserLoggedIn) {
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
                hideQuantityInput(productId);
            } else {
                toastr.error('Failed to add to cart. Please try again.', 'Error');
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

function submitReview(productId) {
    const comment = document.getElementById('review-comment').value;
    const rating = document.getElementById('review-rating').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?url=product/addReview', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                const reviewsContainer = document.getElementById('reviews-container');
                const newReview = document.createElement('div');
                newReview.className = 'review-item';
                newReview.innerHTML = `<p><strong>${response.username}</strong> (Rating: ${response.rating}/5)</p><p>${response.comment}</p>`;
                reviewsContainer.insertBefore(newReview, reviewsContainer.firstChild);
                document.getElementById('review-comment').value = '';
                document.getElementById('review-rating').value = '';
            } else {
                toastr.error('Failed to submit review. Please try again.', 'Error');
            }
        }
    };

    const data = 'product_id=' + encodeURIComponent(productId) +
                '&comment=' + encodeURIComponent(comment) +
                '&rating=' + encodeURIComponent(rating);

    xhr.send(data);
}
