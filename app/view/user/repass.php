<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body> 
<div class="alert text-center title-login">
    <strong>Reset PassWord</strong>
</div>
<div class="sign-up col-md-12 col-md-offset-2 mt-10">
  <form class="sign-up__form" action="index.php?url=user/rspass" method="post">
    <div class="sign-up__content">
      <h2 class="sign-up__title">Nhập Mật Khẩu mới</h2>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
      <input class="sign-up__inp" type="password" placeholder="Mật Khẩu Mới" name="password" required>
      <input class="sign-up__inp" type="password" placeholder="Xác Nhận Mật Khẩu" name="confirm_password" required>
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
    <div class="sign-up__buttons"><a class="btn btn--register" href="login">Back To Login</a>
      <button class="btn btn--signin" type="submit">Submit</button>
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
