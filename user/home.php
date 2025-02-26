<?php include 'component/connection.php';
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
}
?>
<style type="text/css">
    <?php include 'style.css';?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'component/header.php';?>
    <div class="main">
    <section class="home-section">
            <div class="slider">
                <div class="slider_slider slide1">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem</h1>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                    
                </div>
                <!---slide end-->
                <div class="slider_slider slide2">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>welcome to my shop</h1>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end-->
                <div class="slider_slider slide3">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem</h1>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end-->
                <div class="slider_slider slide4">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem</h1>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end-->
                <div class="slider_slider slide5">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem</h1>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end-->
                <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
                <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
            </div>
        </section>
        <!---home slider end-->
        <!-- thumb section-->
        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="img/thumb2.jpg" alt="">
                    <h3>green tea</h3>
                    <p>Lorem ipsum dolor sit .</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb0.jpg" alt="">
                    <h3>lemon tea</h3>
                    <p>Lorem ipsum dolor sit .</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb1.jpg" alt="">
                    <h3>green cofee</h3>
                    <p>Lorem ipsum dolor sit .</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb.jpg" alt="">
                    <h3>green tea</h3>
                    <p>Lorem ipsum dolor sit .</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            </div>

        </section>
        <section class="container">
            <div class="box-container">
                <div class="box">
                    <img src="img/about-us.jpg" alt="">
                </div>
                <div class="box">
                    <img src="img/download.png" alt="">
                    <span>healthy tea</span>
                    <h1>Save upto 50% off</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa similique quo nobis ipsum et
                        culpa, voluptatum id optio laborum consequatur quasi assumenda vel qui velit. Officia ex
                        perspiciatis quisquam ab.</p>
                </div>
            </div>
        </section>
        <section class="shop">
            <div class="title">
                <img src="img/download.png" alt="">
                <h1>Trending product</h1>
            </div>
            <div class="row">
                <img src="img/about.jpg" alt="">
                <div class="row-detail">
                    <img src="img/basil.jpg" alt="">
                    <div class="top-footer">
                        <h1>a cup of green tea make you healthy</h1>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/card.jpg" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/card0.jpg" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/card1.jpg" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/card2.jpg" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/10.jpg" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/6.webp" alt="">
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
            </div>
        </section>
        <section class="shop-category">
            <div class="box-container">
                <div class="box">
                    <img src="img/6.jpg" alt="">
                    <div class="detail">
                        <span>BIG OFFERS</span>
                        <h1>Extra 15% off</h1>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                </div>
                <div class="box">
                    <img src="img/7.jpg" alt="">
                    <div class="detail">
                        <span>new in taste</span>
                        <h1>cofee house</h1>
                        <a href="view_product.php" class="btn">shop now</a>
                    </div>
                </div>
            </div>

        </section>
        <section class="services">
            <div class="box-container">
                <div class="box">
                    <img src="img/icon2.png" alt="">
                    <div class="detail">
                        <h3>great saving</h3>
                        <p>save big every order</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon1.png" alt="">
                    <div class="detail">
                        <h3>22*7 support</h3>
                        <p>one on one support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon0.png" alt="">
                    <div class="detail">
                        <h3>gift vouchher</h3>
                        <p>voucher on every festival</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon.png" alt="">
                    <div class="detail">
                        <h3>world wild delivery</h3>
                        <p>dropship world wide</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="brand">
            <div class="box-container">
                <div class="box">
                    <img src="img/brand (1).jpg">
                </div>
                <div class="box">
                    <img src="img/brand (2).jpg"> 
                </div>
                <div class="box">
                    <img src="img/brand (3).jpg"> 
                </div>
                <div class="box">
                    <img src="img/brand (4).jpg"> 
                </div>
                <div class="box">
                    <img src="img/brand (5).jpg"> 
                </div>
            </div>
        </section>
    <?php include 'component/footer.php';?>
    </div>
  
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'component/alert.php';?>
</body>
</html>