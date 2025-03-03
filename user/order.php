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
    <title> green coffe order page</title>
</head>

<body>
    <?php include 'component/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>my order</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span>/orders</span>
        </div>
        <section class="orders">
                 <div class="title">
                 <img src="img/download.png" class="logo">
                 <h1>my order</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dicta nisi voluptas culpa quo est porro blanditiis voluptate error similique unde eius fuga sapiente, tempora nulla voluptatibus provident earum sit.</p>
                </div>
                <div class="box-container">
                <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
                    $select_orders->execute([$user_id]);
                    if ($select_orders->rowCount()>0){
                        while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_products->execute([$fetch_order['product_id']]);
                            if($select_products->rowCount()>0){
                                while($fetch_product=$select_products->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <div class="box" <?php if($fetch_order['status']=='cancel'){echo 'style="border:2px solid red";';} ?>>
                                <a href="view_order.php?get_id=<?= $fetch_order['id'];?>">
                            <p class="date"><i class="bi bi-calendar-fill"></i><span><?=$fetch_order['date'];?></span></p>
                             <img src="img/<?= $fetch_product['image'];?>" class="image">
                             <div class="row">
                                <h3 class="name"><?= $fetch_product['name'];?></h3>
                                <p class="price">price: $<?= $fetch_order['price']; ?>x <?= $fetch_order['qty'];?></p>
                                <p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='canceled'){echo 'red';}else{echo 'orange';}?>"></p>
                             </div>
                        </a></div>
                            <?php
                                }
                            }
                        }
                    }else
                    {
                        echo '<p class="empty">no order yet</p>';
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