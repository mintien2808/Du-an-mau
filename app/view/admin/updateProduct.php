<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/style.css">
</head>
<body>
    <div class="alert text-center title-login">
        <strong>Chỉnh sửa sản phẩm</strong>
    </div>
    <div class="sign-up col-md-12 col-md-offset-2 mt-10">
        <form class="sign-up__form" action="" method="post" enctype="multipart/form-data">
            <div class="sign-up__content">
                <h2 class="sign-up__title">Chỉnh sửa sản phẩm</h2>

                <input class="sign-up__inp" type="text" placeholder="Tên sản phẩm" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
                <?php if (isset($errors['name'])) echo "<p style='color:red;'>{$errors['name']}</p>"; ?>

                <input class="sign-up__inp" type="number" placeholder="Giá" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                <?php if (isset($errors['price'])) echo "<p style='color:red;'>{$errors['price']}</p>"; ?>

                <input class="sign-up__inp" type="number" placeholder="Số lượng" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>">
                <?php if (isset($errors['quantity'])) echo "<p style='color:red;'>{$errors['quantity']}</p>"; ?>

                <textarea class="sign-up__inp" placeholder="Mô tả" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                <?php if (isset($errors['description'])) echo "<p style='color:red;'>{$errors['description']}</p>"; ?>

                <input class="sign-up__inp" type="file" name="image">
                <?php if (isset($errors['image'])) echo "<p style='color:red;'>{$errors['image']}</p>"; ?>
2
                <select name="id_cate" id="category" class="sign-up__inp">
                    <?php
                    foreach ($categories as $category) {
                        $selected = ($product['id_cate'] == $category['id']) ? 'selected' : '';
                        echo "<option value=\"{$category['id']}\" $selected>{$category['name']}</option>";
                    }
                    ?>
                </select>
                <?php if (isset($errors['category'])) echo "<p style='color:red;'>{$errors['category']}</p>"; ?>
            </div>
            <div class="sign-up__buttons">
                <a class="btn btn--register" href="index.php?url=admin/products">Quay Lại</a>
                <button class="btn btn--signin" type="submit">Cập Nhật Sản Phẩm</button>
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
