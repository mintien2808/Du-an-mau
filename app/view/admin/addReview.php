<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/style.css">
</head>
<body>

    <div class="container">
    <div class="alert text-center title-login">
        <strong>Thêm sản phẩm</strong>
    </div>
        <form class="sign-up__form" action="" method="post">
            <div class="sign-up__content">
            <h2 class="sign-up__title">Thêm sản phẩm</h2>
                <input class="sign-up__inp" type="number" min="1" max="5" placeholder="Điểm đánh giá (1-5)" name="rating" >
                <?php if (isset($errors['rating'])) echo "<p style='color:red;'>{$errors['rating']}</p>"; ?>
                
                <textarea class="sign-up__inp" placeholder="Bình luận" name="comment" ></textarea>
                <?php if (isset($errors['comment'])) echo "<p style='color:red;'>{$errors['comment']}</p>"; ?>
                
                <input class="sign-up__inp" type="text" placeholder="ID Người Dùng" name="user_id" >
                <?php if (isset($errors['user_id'])) echo "<p style='color:red;'>{$errors['user_id']}</p>"; ?>

                <input class="sign-up__inp" type="text" placeholder="Tên Người Dùng" name="username" >
                <?php if (isset($errors['username'])) echo "<p style='color:red;'>{$errors['username']}</p>"; ?>

                <input class="sign-up__inp" type="text" placeholder="ID Sản Phẩm" name="product_id" >
                <?php if (isset($errors['product_id'])) echo "<p style='color:red;'>{$errors['product_id']}</p>"; ?>
            </div>
            <div class="sign-up__buttons">
            <a class="btn btn--register" href="../index.php?url=admin">Quay Lại</a>
                <button class="btn btn--signin" type="submit">Thêm Đánh Giá</button>
            </div>
        </form>
    </div>
</body>
</html>