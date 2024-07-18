<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/du-an-mau/public/css/style.css">
</head>
<style>
    /* Tổng thể */
body {
    background-color: #ffffff;
    font-family: 'Courier New', monospace;
    color: #2d2d2d;
    line-height: 1.6;
}

/* Tiêu đề */
h2 {
    margin-top: 50px;
    color: #1a1a1a;
    text-align: right;
    font-size: 24px;
    font-style: italic;
    letter-spacing: 2px;
}

/* Container của form */
.sign-up {
    background-color: #f0f0f0;
    padding: 50px;
    border: 2px solid #333;
    border-radius: 4px;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
    margin: 50px auto;
    max-width: 800px;
}

/* Các input của form */
.sign-up__inp {
    width: calc(100% - 20px);
    margin-bottom: 25px;
    padding: 15px;
    border: 1px solid #888;
    border-radius: 2px;
    background-color: #e0e0e0;
    color: #000;
    transition: background-color 0.3s, transform 0.3s;
}

.sign-up__inp:focus {
    background-color: #c0c0c0;
    transform: scale(1.02);
}

/* Nút submit của form */
.btn--signin {
    background-color: #444;
    color: #fff;
    border: 1px solid #222;
    padding: 12px 24px;
    border-radius: 2px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    font-size: 14px;
}

.btn--signin:hover {
    background-color: #000;
    transform: scale(1.1);
}

/* Nút quay lại của form */
.btn--register {
    background-color: #007bff;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 2px;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
}

.btn--register:hover {
    background-color: #0056b3;
}

/* Thông báo lỗi */
.error-message {
    color: #b94a48;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
}

/* Các vòng tròn màu sắc */
.circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: absolute;
    bottom: 20px;
}

.circle--red {
    background-color: red;
    left: 20px;
}

.circle--yellow {
    background-color: yellow;
    left: 80px;
}

.circle--green {
    background-color: green;
    left: 140px;
}

.circle--purple {
    background-color: purple;
    left: 200px;
}

</style>
<body>
    <div class="alert text-center title-login">
        <strong>Sửa</strong>
    </div>
    <div class="sign-up col-md-12 col-md-offset-2 mt-10">
        <form class="sign-up__form" action="" method="post" enctype="multipart/form-data">
            <div class="sign-up__content">
                <h2 class="sign-up__title">Sửa</h2>
                <input class="sign-up__inp" type="text" placeholder="Tài Khoản" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                <?php if (isset($errors['username'])) echo "<p style='color:red;'>{$errors['username']}</p>"; ?>
                
                <input class="sign-up__inp" type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                <?php if (isset($errors['email'])) echo "<p style='color:red;'>{$errors['email']}</p>"; ?>
                
                <input class="sign-up__inp" type="tel" placeholder="Số điện thoại" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                <?php if (isset($errors['phone'])) echo "<p style='color:red;'>{$errors['phone']}</p>"; ?>
                
                <input class="sign-up__inp" type="password" placeholder="Password" name="password">
                <?php if (isset($errors['password'])) echo "<p style='color:red;'>{$errors['password']}</p>"; ?>
                
                <input class="sign-up__inp" type="password" placeholder="Password Confirm" name="confirm_password">
                <?php if (isset($errors['confirm_password'])) echo "<p style='color:red;'>{$errors['confirm_password']}</p>"; ?>
                
                <input class="sign-up__inp" type="text" placeholder="Địa chỉ" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                <?php if (isset($errors['address'])) echo "<p style='color:red;'>{$errors['address']}</p>"; ?>
                
                <input class="sign-up__inp" type="file" name="image">
                <?php if (isset($errors['image'])) echo "<p style='color:red;'>{$errors['image']}</p>"; ?>
                
                <select name="role" id="role" class="sign-up__inp">
                    <?php
                    $role = array(
                        'admin' => 'Quản trị viên',
                        'user' => 'Người dùng'
                    );
                    foreach ($role as $key => $value) {
                        $selected = ($user['role'] == $key) ? 'selected' : '';
                        echo "<option value=\"$key\" $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="sign-up__buttons">
                <a class="btn btn--register" href="index.php?url=admin/index">Quay Lại</a>
                <button class="btn btn--signin" type="submit">Chỉnh Sửa</button>
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
