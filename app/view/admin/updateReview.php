<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mã giảm giá</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/style.css">
</head>
<body>
    <div class="alert text-center title-login">
        <strong>Thêm Mã giảm giá</strong>
    </div>
    <div class="sign-up col-md-12 col-md-offset-2 mt-10">
            <form class="sign-up__form" action="" method="post" enctype="multipart/form-data">
            <div class="sign-up__content">
                <h2 class="sign-up__title">Thêm Đánh Giá</h2>

                <label for="rating">Điểm đánh giá (1-5):</label>
                <input class="sign-up__inp" id="rating" type="number" min="1" max="5" placeholder="Điểm đánh giá" name="rating" >
                <?php if (isset($errors['rating'])) echo "<p style='color:red;'>{$errors['rating']}</p>"; ?>

                <label for="comment">Bình luận:</label>
                <textarea class="sign-up__inp" id="comment" name="comment" placeholder="Nhập bình luận" ></textarea>
                <?php if (isset($errors['comment'])) echo "<p style='color:red;'>{$errors['comment']}</p>"; ?>
            </div>
            <div class="sign-up__buttons">
            <a class="btn btn--register" href="../index.php?url=admin">Quay Lại</a>
                <button class="btn btn--signin" type="submit">Thêm Đánh Giá</button>
            </div>
        </form>
    </div>
    <div class="col-md-10 col-md-offset-2 ">
        <div class="circle circle--red"></div>
        <div class="circle circle--yellow"></div>
        <div class="circle circle--green"></div>
        <div class="circle circle--purple"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>