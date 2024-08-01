<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/style.css">
</head>
<body>
    <div class="alert text-center title-login">
        <strong>Thêm người dùng</strong>
    </div>
    <div class="sign-up col-md-12 col-md-offset-2 mt-10">
        <form class="sign-up__form" action="adduser" method="post" enctype="multipart/form-data">
            <div class="sign-up__content">
                <h2 class="sign-up__title">Thêm</h2>                
                <input class="sign-up__inp" type="text" placeholder="Tài Khoản" name="username">      
                <input class="sign-up__inp" type="email" placeholder="Email" name="email">
                <input class="sign-up__inp" type="tel" placeholder="Số điện thoại" name="phone">
                <input class="sign-up__inp" type="password" placeholder="Password" name="password">
                <input class="sign-up__inp" type="password" placeholder="Password Confirm" name="confirm_password">
                <input class="sign-up__inp" type="text" placeholder="Địa chỉ" name="address">
                <input class="sign-up__inp" type="file" name="image"> 
                <select name="role" id="role" class="sign-up__inp">
                    <?php
                    $role = array(
                        'admin' => 'Quản trị viên',
                        'user' => 'Người dùng'
                    );
                    foreach ($role as $key => $value) {
                        echo "<option value=\"$key\">$value</option>";
                    }
                    ?>
                </select>
                <?php 
                if (!empty($errors)) {
                    echo "<ul style='color:red;'>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
            <div class="sign-up__buttons">
                <a class="btn btn--register" href="admin">Quay Lại</a>
                <button class="btn btn--signin" type="submit">Thêm Người Dùng</button>
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
