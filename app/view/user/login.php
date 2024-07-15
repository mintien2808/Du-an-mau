<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body> 
<div class="alert text-center title-login">
    <strong>Trang đăng nhập</strong>
</div>
<div class="sign-up col-md-12 col-md-offset-2 mt-10">
  <form class="sign-up__form" action="login" method="post">
    <div class="sign-up__content">
      <h2 class="sign-up__title">Login</h2>
      <input class="sign-up__inp" type="text" placeholder="Tài Khoản" name="username" >
      <input class="sign-up__inp" type="password" placeholder="Password" name="password" >
      <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
      <a class="forgot__password" href="fgpw">Forgot password</a>
    </div>
    <div class="sign-up__buttons"><a class="btn btn--register" href="register">Đăng Ký</a>
      <button class="btn btn--signin" type="submit">Đăng Nhập</button>
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
