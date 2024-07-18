<?php include_once('include/header.php'); ?>


<style>
    li.sanPham button{
        height: 10px;
    }
    h2.danhMuc{
        /* border: 2px solid red; */
    }
    h1.sanPham{

    }
</style>
<div class="content">
        <h2 class="danhMuc">Danh Mục</h2>
        <main>
            <ul>
                <li class="anh anh2">
                    <a href="#"><img src="pic/category1-img.webp" alt=""></a>
                    <h5>SIGNATURE</h5>
                </li>
                <li class="anh">
                    <a href="#"><img src="pic/category2-img.webp" alt=""></a>
                    <h5>Back In Stock</h5>
                </li>
                <li class="anh">
                    <a href="#"><img src="pic/category3-img.webp" alt=""></a>
                    <h5>Áo Kiểu</h5>
                </li>
                <li class="anh">
                    <a href="#"><img src="pic/category4-img.webp" alt=""></a>
                    <h5>Áo Thun</h5>
                </li>
                <li class="anh">
                    <a href="#"><img src="pic/category5-img.webp" alt=""></a>
                    <h5>Đầm </h5>
                </li>
                <li class="anh">
                    <a href="#"><img src="pic/category5-img.webp" alt=""></a>
                    <h5>Quần</h5>
                </li>
                
            </ul>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li class="anh">
                        <a href="index.php?url=Product/showByCategory/<?php echo $category['id']; ?>" class="category">
                            <img src="<?php echo $category['img']; ?>" alt="">
                        </a>
                        <h5><?php echo $category['name']; ?></h5>
                    </li>
                <?php endforeach; ?>
            </ul>
            
        </main>

        <br>
        
        <main class="main2">
        <h1 class="sanPham">Sản Phẩm</h1>
            <div class="sanPham">  
            <ul>
                        <li class="sanPham">
                            <a href="sanPham.html"><img src="pic/pro_kem_1_9eec61e7dfd642c981a0749844af2b29_grande.webp"
                                    alt="" class="to-ra"></a>
                            <h3>Đầm midi 2 dây tay phông ra hong...</h3>
                            <p>795,000đ</p> <a href="sanPham.html" class="hover"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_xanh_duong_01_3_43a8312267174978b90159285c178d90_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm suông mini 2 tầng phối viền ren</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hoa_01_1_8fe02dfc37cf47b998f2b936e3335f14_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3> Đầm hoa midi 2 dây cổ tim rã hông</h3>
                            <p>595,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_trang_01_1_6f20a8c845b745b6bdeb66aaee1240cc_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm mini cổ vuông rã thân xếp li hông</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                    </ul>      
                <ul>
                    <?php 
                    $count = 0; 
                    foreach ($products as $product): ?>
                        <?php if (isset($selectedCategory) && $product['category_id'] == $selectedCategory): ?>
                            <li class="sanPham">
                                <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="" class="to-ra"></a>
                                <h3><?php echo $product['name']; ?></h3>
                                <p><?php echo $product['price']; ?>đ</p>
                                <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><button>Mua</button></a>
                            </li>
                            <?php 
                            $count++;
                            if ($count % 5 == 0) { 
                                echo '</ul><ul>';
                            }
                            ?>
                        <?php else: ?>
                            <li class="sanPham">
                                <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="" class="to-ra"></a>
                                <h3><?php echo $product['name']; ?></h3>
                                <p><?php echo $product['price']; ?>đ</p>
                                <a href="index.php?url=Product/detail/<?php echo $product['id']; ?>"><button>Mua</button></a>
                            </li>
                            <?php 
                            $count++;
                            if ($count % 5 == 0) { 
                                echo '</ul><ul>';
                            }
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="sanPham">
                    <ul>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hong_01_1_9950f9f440464488b5902e4ca9ed2146_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm mini 2 dây form suông đính nơ ngực</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hoa_01_2_3349c36c4c8541488eb30e977b667d41_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm hoa mini bẹt vai smocking</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_xanh_duong_01_1_19cb66ef39c74413986f6415ca518b3a_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3> Áo kiểu cổ yếm phối bèo lưng thun</h3>
                            <p>295,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hoa_02_2_76b68afd31f943efb57e2b9d0a5a3374_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Áo kiểu cổ yếm phối bèo lưng thun</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                    </ul>
                </div>
                <!-- end sản phẩm -->
                <div class="sanPham">
                    <ul>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hoa_02_3_661b953d29904931836049dfb9896304_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Áo hoa 2 dây croptop rút nhún ngực</h3>
                            <p>355,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hong_01_1_eba7ec1d3d424d1088552aab0481bf54_grande.webp" alt=""
                                    class="to-ra"> </a>
                            <h3> Áo thun sọc tay ngắn form ôm</h3>
                            <p>175,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_xanh_la_01_3_578af4666aca436b989fbf9eaa840cfd_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3> Áo 2 dây lụa rút dây cổ đổ</h3>
                            <p>355,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img src="pic/pro_den_3_1c5a5aaa05e34eea905f470fa4485c48_grande.webp"
                                    alt="" class="to-ra"></a>
                            <h3>Đầm mini thêu hoa tay phồng phối lá cổ</h3>
                            <p>795,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                    </ul>
                </div>
                <!-- end sản phẩm -->
                <div class="sanPham">
                    <ul>
                        <li class="sanPham">
                            <a href="sanPham.html"><img src="pic/pro_kem_1_9eec61e7dfd642c981a0749844af2b29_grande.webp"
                                    alt="" class="to-ra"></a>
                            <h3>Đầm midi 2 dây tay phông ra hong...</h3>
                            <p>795,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_xanh_duong_01_3_43a8312267174978b90159285c178d90_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm suông mini 2 tầng phối viền ren</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_hoa_01_1_8fe02dfc37cf47b998f2b936e3335f14_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3> Đầm hoa midi 2 dây cổ tim rã hông</h3>
                            <p>595,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_trang_01_1_6f20a8c845b745b6bdeb66aaee1240cc_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm mini cổ vuông rã thân xếp li hông</h3>
                            <p>495,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                    </ul>
                </div>
                <!-- end sản phẩm -->
                

                <h1 class="sanPham">BEST SELLER</h1>
                <div class="sanPham">
                    <ul>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_tim_01_3_082ac4684c2a4bc89d0c6e71a55ea44a_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Áo thun crop tay ngắn cổ V cài nút</h3>
                            <p>255,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_tim_01_2_e9d14b97d45a4befa75e0a511bac3e8a_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Áo thun ôm 2 dây cơ bản</h3>
                            <p>155,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_cam_02_3_604dbf3edd134855a65befd47de38e1d_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3> Áo thun polo basic</h3>
                            <p>255,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                        <li class="sanPham">
                            <a href="sanPham.html"><img
                                    src="pic/pro_xam_nhat_1_84e0b37207674ebc99bd3631a4bfd00f_grande.webp" alt=""
                                    class="to-ra"></a>
                            <h3>Đầm babydoll tay phồng phối lá cổ</h3>
                            <p>295,000đ</p><a href="sanPham.html"><button>Mua</button></a>
                        </li>
                    </ul>
                </div>
                <!-- end sản phẩm -->
        </main> 
        <!-- main2 -->
</div>

<?php include_once('include/footer.php'); ?>

