<style>
    
/* fotter */
footer img{
    /* border: 2px solid red; */
    width: 120px;
    margin-left: 30px;
    margin-top: 2px;
}

div.footer ul{
    /* border: 2px solid red; */
    height: 500px;
    width: 100%;
    display: inline-flex;
}
div.footer li{
    padding: 10px 50px;
    list-style: none;
}
div.icon img{
    width: 40px;
}
div.icon ul{
    /* border: 2px solid red; */
    height: 100px;
    display: inline-flex;
    padding-left: 5px;
}
div.icon li{
    list-style: none;
}
li.footer{
    /* border: 2px solid blue; */
    width: 300px;
}
li.footer a{
    text-decoration: none;
    color: black;
}
li.footer a :hover{
    color:  red;
    text-decoration: underline;
}
section.anh{
    margin-left: 75px;
    width: 1400px;
}




ul.dropdown{
    display: none;
}
/* @media only screen and (max-width:1000px) {
    .keoDeAn{
        display: none;
    }



} */


/* 
 @media (min-width:576px){
    .container{
        max-width: 720px;
    }
 }

 @media (min-width:768px){
    .container{
        max-width: 720px;
    }
 }
 @media (min-width:992px){
    .container{
        max-width: 960px;
    }
 }
 @media (min-width:1200px){
    .container{
        max-width: 960px;
    }
 } */


/* Reset and general styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', 'Arial', sans-serif;
    background-color: #f5f5f5;
    line-height: 1.6;
}

.container {
    width: 100%;
    max-width: 1400px; /* Adjust max-width as needed */
    margin: 0 auto;
    padding: 0 20px;
}

/* Header styles */
header {
    background-color: #333; /* Dark background */
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

nav ul {
    list-style-type: none;
    display: flex;
}

nav ul li {
    padding: 10px 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

nav ul li a:hover {
    text-decoration: underline;
}

.logo {
    width: 120px; /* Adjust logo size */
}

/* Main content styles */
.main-content {
    padding: 20px;
}

.sanPham {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.sanPham li {
    width: 280px;
    margin: 10px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.sanPham li img {
    width: 100%;
    height: auto;
}

.sanPham li h3, .sanPham li p {
    margin: 10px 0;
}

.sanPham li button {
    background-color: #ff6347;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 10px;
}

.sanPham li button:hover {
    background-color: #42e57b;
    transform: scale(1.1);
}

/* Footer styles */
footer {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
    width: 1377px;
}

.footer ul {
    list-style-type: none;
}

.footer ul li {
    padding: 10px 0;
}

.footer ul li a {
    color: #fff;
    text-decoration: none;
}

.footer ul li a:hover {
    text-decoration: underline;
}
div.khuyenMai{
    width: 1377px;

}

section.anh{
    width: 1210px;
}
div.sanPham button{
    padding-bottom: 40px;
    margin-bottom: 50px;
}
footer{
    width: 100%;
    /* border: 2px solid red; */
    margin-right: 30px;

}
</style>
<footer>
            <a href="#"><img src="pic/logo.webp" alt=""></a>
            <div class="icon">
                <ul>
                    <li>
                        <a href=""><img src="pic/tai1.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="pic/tai2.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="pic/tai3.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="pic/tai4.png" alt=""></a>
                    </li>
                </ul>

            </div>

            <div class="footer">
                <ul class="footer">
                    <li class="footer">
                        <p>Thương hiệu thời trang MARC - CÔNG TY CỔ PHẦN SẢN XUẤT THƯƠNG MẠI NÉT VIỆT
                            Địa chỉ: Tầng 15.06 Tòa nhà Văn phòng Golden King, Số 15 Nguyễn Lương Bằng, Phường Tân Phú,
                            Quận 7, Tp. HCM</p>
                        <br>
                        <p>Chính sách bảo mật
                            Các điều khoản và điều kiện
                        </p>
                    </li>
                    <li class="footer">
                        <h2>Về chúng tôi</h2>
                        <a href="#">
                            <p>Giới thiệu MARC</p>
                        </a>
                        <a href="#">
                            <p>Tuyển dụng</p>
                        </a>
                        <a href="#">
                            <p>Cảm hứng thời trang</p>
                        </a>
                        <a href="#">
                            <p>Danh sách cửa hàng</p>
                        </a>
                        <a href="#">
                            <p>Nhượng quyền thương hiệu</p>
                        </a>
                        <a href="#">
                            <p>Khách hàng thân thiết</p>
                        </a>
                        <a href="#">
                            <p>Chính sách giao hàng</p>
                        </a>


                    </li>
                    <li class="footer">
                        <h2>Hỗ trợ khách hàng</h2>
                        <a href="lienHe.html">
                            <p>Liên hệ đến MARC</p>
                        </a>
                        <a href="#">
                            <p>Câu hỏi thường gặp</p>
                        </a>
                        <a href="#">
                            <p>Hướng dẫn tạo tài khoản</p>
                        </a>
                        <a href="#">
                            <p>Hướng dẫn đặt hàng</p>
                        </a>
                        <a href="#">
                            <p>Mua Online nhận tại cửa hàng</p>
                        </a>
                        <a href="#">
                            <p>Hướng dẫn mua trước trả sau</p>
                        </a>
                        <a href="#">
                            <p>Quy định và hướng dẫn đổi/trả hàng</p>
                        </a>
                        <a href="#">
                            <p>Hướng dẫn đánh giá sản phẩm</p>
                        </a>

                    </li>
                    <li class="footer">
                        <h2>Liên lạc</h2>
                        <p>Đặt hàng trực tuyến (8h-21h)

                            1900 636942</p>

                        <p>Chăm sóc khách hàng

                            1900 636940</p>


                        <p>nguyenDinhAnh@gmail.com</p>

                    </li>
                </ul>
            </div>


        </footer>
    </div> <!-- end container -->

</body>

</html>