<?php include 'component/connection.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
}else{
    $get_id ='';
    header('location:order.php');
}
if (isset($_POST['cancel'])){
    $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id=?");
    $update_order->execute(['canceled', $get_id]);
    header('location:order.php');
}
?>
<style type="text/css">
    <?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title> green coffe order detail page</title>
</head>

<body>
    <?php include 'component/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>my order</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span> / orders</span>
        </div>
        <section class="order-detail">
      
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>order detail</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dicta nisi voluptas culpa quo est porro blanditiis voluptate error similique unde eius fuga sapiente, tempora nulla voluptatibus provident earum sit.</p>
            </div>
            <div class="box-container">
                 <?php
                 $grand_total=0;
                 $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id=? LIMIT 1");
                 $select_orders->execute([$get_id]);
                 if ($select_orders->rowCount()>0){
                    while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
                        $select_product->execute([$fetch_order['product_id']]);
                        if ($select_product->rowCount()>0){
                            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                                $sub_total=($fetch_order['price'] * $fetch_order['qty']);
                                $grand_total += $sub_total;
                             ?>
                             <div class="box">
                                <div class="col">
                                    <p class="title"><i class="bx bx-calendar"></i><?= $fetch_order['date'];?></p>
                                    <img src="img/<?= $fetch_product['image'];?>" class="image">
                                    <p class="price">price: $<?= $fetch_product['price']; ?>x <?= $fetch_order['qty'];?></p>
                                    <h3 class="name"><?= $fetch_product['name'];?></h3>
                                    <p class="grand-total"> Total Amount of Payable:<span>$<?= $grand_total;?></span></p>
                                </div>
                                <div class="col">
                                    <p class="title">billing adress</p>
                                    <p class="user"><i class="bx bx-user"></i><?= $fetch_order['name'];?></p>
                                    <p class="user"><i class="bx bx-phone"></i><?= $fetch_order['number'];?></p>
                                    <p class="user"><i class="bx bx-envelope"></i><?= $fetch_order['email'];?></p>
                                    <p class="user"><i class="bx bx-home"></i><?= $fetch_order['address'];?></p>
                                    <p class="title">status</p>
                                    <p class="status" style="color:<?php if ($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='canceled'){echo 'red';}else{echo 'orange';}?>"><?= $fetch_order['status']?></p>
                                    <?php if ($fetch_order['status']=='canceled'){ ?>
                                        <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>

                                  <?php  }else{?>
                                    <form method="post">
                                        <button type="submit" name="cancel" class="btn" onclick="return confirm('do you want to cancel this order')">cancel order</button>

                                    </form>
                                <?php } ?>
                                </div>
                             </div>
                             <?php
                            }
                        }else{
                            echo '<p class="empty">product not found</p>';
                        }
                    }
                }else{
                    echo '<p class="empty">no order foundt</p>';
                }
                ?>
            </div>

        </section>
        <?php include 'component/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'component/alert.php'; ?>
</body>

</html>