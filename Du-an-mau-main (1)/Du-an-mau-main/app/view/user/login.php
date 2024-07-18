<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<style>
  body {
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
}

.title-login {
    background-color: #007bff;
    color: white;
    font-size: 24px;
    padding: 10px;
    margin-bottom: 20px;
}

.sign-up {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: auto;
    margin-top: 50px;
}

.sign-up__title {
    font-size: 22px;
    margin-bottom: 20px;
    color: #333;
}

.sign-up__inp {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.forgot__password {
    display: block;
    text-align: right;
    margin-bottom: 20px;
    color: #007bff;
    text-decoration: none;
}

.sign-up__buttons {
    text-align: center;
}

.btn--register,
.btn--signin {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
}

.btn--register:hover,
.btn--signin:hover {
    background-color: #0056b3;
}

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
    <div class="sign-up__buttons"><a class="btn btn--register" href="../Du-an-mau-main/app/view/user/register.php">Đăng Ký</a>
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
