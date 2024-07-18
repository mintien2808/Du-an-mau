<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body, * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
            border: none;
            outline: none;
            scroll-behavior: smooth;
            font-family: 'Roboto', sans-serif;
        }

        :root {
            --main-color: #ff6347;
        }

        body {
            font-size: 100%;
            background-color: #f5f5f5;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        nav li {
            padding: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav li:hover a {
            text-decoration: underline;
            color: blue;
        }

        .sanPham {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px 0;
        }

        .sanPham li {
            list-style-type: none;
            margin: 10px;
            padding: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .sanPham img {
            width: 100%;
            height: auto;
            display: block;
        }

        .sanPham h3, .sanPham p {
            margin: 10px 0;
        }

        .sanPham button {
            background-color: var(--main-color);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .sanPham button:hover {
            background-color: #e55342;
            transform: scale(1.1);
        }

        .footerContent {
            display: flex;
            justify-content: space-around;
            padding: 20px 0;
            background-color: #333;
            color: white;
        }

        .footerContent img {
            width: 200px;
            height: auto;
        }

        .mienPhi {
            color: white;
            background-color: black;
            width: 100%;
            height: 25px;
            text-align: center;
            padding: 5px;
        }

        .container header {
            font-size: 20px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .container img.logo {
            width: 120px;
        }

        header nav {
            height: 50px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: white;
        }

        li.rieng {
            padding: 10px 20px;
            list-style: none;
        }

        li.rieng1 {
            padding-left: 250px;
        }

        li.rieng a {
            color: black;
        }

        section.anh img, section.anh video {
            width: 100%;
        }

        section.anh {
            width: 100%;
            margin: 0 auto;
            display: block;
        }

        .content h2 {
            width: 100%;
            text-align: center;
        }

        main ul {
            width: 100%;
            display: flex;
            padding: 10px 70px;
            margin-left: 50px;
        }

        main li {
            padding: 10px 30px;
        }

        main li.anh2 {
            padding-left: 180px;
        }

        li.anh img {
            width: 90px;
        }

        li.anh {
            list-style: none;
        }

        li.rieng img {
            width: 40px;
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
            }

            .rieng1 {
                padding-left: 0;
            }

            main ul {
                flex-direction: column;
                margin-left: 0;
                padding: 0;
            }

            main li {
                padding: 10px 0;
            }

            .mienPhi {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="mienPhi">
            MIỄN PHÍ ĐỔI HÀNG TRONG 30 NGÀY
        </div>
        <header>
            <nav>
                <ul class="keoDeAn">
                    <li class="rieng0">
                        <a href="#">
                            <img src="pic/logo.webp" alt="" class="logo">
                        </a>
                    </li>
                    <li class="rieng rieng1"><a href="#">Trang chủ</a></li>
                    <li class="rieng"><a href="sanPham.html">Sản Phẩm</a></li>
                    <li class="rieng"><a href="#">Look Book</a></li>
                    <li class="rieng"><a href="#">Dịp/Sự Kiện</a></li>
                    <li class="rieng"><a href="#">BLOG</a></li>
                    <li class="rieng"><a href="#">Cửa Hàng</a></li>
                    <li class="rieng"><a href="../Du-an-mau-main/app/view/user/login.php">Đăng Nhập</a></li>
                </ul>
            </nav>
        </header>
        <section class="anh">
            <video width="1300" src="video/video.mp4" autoplay muted></video>
        </section>
    </div>
    









</body>

</html>
