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
<?php
if(isset($_POST['submit-btn'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $subject = $_POST['subject'];
    $subject = filter_var($subject, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

            $insert_message = $conn->prepare("INSERT INTO `message`(`id`, `name`,`subject`, `email`,`number`, `message`) VALUES (?, ?, ?, ?,?,?)");
            $insert_message->execute([$id, $name, $subject,$email, $number,$message]);
            $success_msg[] = "message send successfully";
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
    <div class="banner">
            <h1>contact us</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span>contact us</span>
        </div>
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
        <div class="form-container">
            <form action="" method="post">
                <div class="title">
                    <img src="img/download.png" class="logo" alt="">
                    <h1>leave a message</h1>
                </div>
                <div class="input-fied">
                    <p>your name:</p>
                    <input type="text" name="name">

                </div>
                <div class="input-fied">
                    <p>subject:</p>
                    <input type="text" name="subject">

                </div>
                <div class="input-fied">
                    <p>your email:</p>
                    <input type="email" name="email">

                </div>
                <div class="input-fied">
                    <p>your number:</p>
                    <input type="text" name="number">

                </div>
                <div class="input-fied">
                    <p>your message:</p>
                    <textarea name="message"></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">send message</button>
            </form>
           
        </div>
        <div class="adress">
                <div class="title">
                    <img src="img/download.png" class="logo" alt="">
                    <h1>contact detail</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. </p>
                </div>
                <div class="box-container">
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>adress</h4>
                            <p>1092 meri gold road</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-phone-call"></i>
                        <div>
                            <h4>phone number</h4>
                            <p>10924148</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>email</h4>
                            <p>praik@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
    <?php include 'component/footer.php';?>
    </div>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'component/alert.php';?>
</body>
</html>