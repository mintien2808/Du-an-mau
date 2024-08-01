<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/formal.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <header>
            <nav>
                <ul class="keoDeAn">
                <li class="rieng0"> <a href="#">
                            <img src="pic/logo.webp" alt="" class="logo">
                        </a></li>
                    <li class="rieng rieng1"><a href="home">Trang chủ</a></li>
                    <li class="rieng"><a href="index.php?url=cart/viewCart">Cart</a></li>
                    <?php 
                    if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                        echo '<li class="rieng"><a href="admin">Admin</a></li>';
                    }
                    ?>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <?php 
                    if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
                     echo '<li class="rieng"><a href="user/login">Đăng Nhập</a></li> ';
                    }else{
                        echo '<li class="rieng"><a href="index.php?url=user/profile/'.$_SESSION['user']['id'].'">Thông Tin người dùng</a></li>';
                        echo '<li class="rieng"><a href="user/logout">Đăng Xuất</a></li>';
                    }
                    ?>
                    
                </ul>
                
                <ul class="dropdown">
                <li class="rieng0"> <a href="#">
                            <img src="pic/logo.webp" alt="" class="logo">
                        </a></li>
                    <li class="rieng rieng1"><a href="home">Trang chủ</a></li>
                    <li class="rieng"><a href="index.php?url=cart/viewCart">Cart</a></li>
                    <?php 
                    if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                        echo '<li class="rieng"><a href="admin">Admin</a></li>';
                    }
                    ?>
                    <li class="rieng"><a href="introduce">About Us</a></li>
                    <?php 
                    if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
                     echo '<li class="rieng"><a href="user/login">Đăng Nhập</a></li> ';
                    }else{
                        echo '<li class="rieng"><a href="user/logout">Đăng Xuất</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </header>
