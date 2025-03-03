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
if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number =  filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email  = filter_var($email , FILTER_SANITIZE_STRING);
    $address = $_POST['flat'].','.$_POST['street'].','.$_POST['city'].','.$_POST['country'].','.$_POST['pincode'];
    $address = filter_var($address , FILTER_SANITIZE_STRING);
    $address_type = $_POST['adress_type'];
    $address_type = filter_var($address_type , FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method,  FILTER_SANITIZE_STRING);
    $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? ");
    $varify_cart->execute([$user_id]);

    if(isset($_GET['get_id'])){
        $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1 ");
        $get_product->execute([$_GET['get_id']]);
        if ($get_product->rowCount() > 0) {
            while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
                $insert_order = $conn->prepare("INSERT INTO `orders`(`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, $method,`product_id`  `price`, `qty`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address,$address_type, $method, $fetch_p['id'],$fetch_p['price'],1]);
                header('location:order.php');
            }
        }else{
            $warning[] = 'something went wrong';
        }
    }elseif ($varify_cart->rowCount()>0){
        while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
            $insert_order = $conn->prepare("INSERT INTO `orders`(`id`, `user_id`, `name`, `number`, `email`, `address`, `adress_type`, method, `product_id`, `price`, `qty`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'],$f_cart['qty']]);
            header('location:order.php');
            $success_msg[] = "order placed successfully";
        }  
        if ($insert_order){
            $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart_id->execute([$user_id]);
            header('location:order.php');
        }
    }else{
        $warning_msg[] = 'something went wrong';
    }

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
    <title> green coffe checkout page</title>
</head>

<body>
    <?php include 'component/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>checkout summery</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span> / checkout summery</span>
        </div>
        <section class="checkout">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>checkout summery</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, tempora dolorum. Porro
                    sapiente, perferendis sequi, veniam repellendus a veritatis dolor possimus laudantium corporis
                    recusandae debitis ab alias ea vel aliquid?</p>
            </div>
            <div class="summary">
                <h3>my bag</h3>
                <div class="box-container">
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
                        $select_get->execute([$_GET['get_id']]);
                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;
                            ?>
                            <div class="flex">
                                <img src="img/<?= $fetch_get['image']; ?>" class="image">
                                <div>
                                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                                    <p class="price"><?= $fetch_get['price']; ?>/-</p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                                $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                                $grand_total += $sub_total;

                                ?>
                                <div class="flex">
                                    <img src="img/<?= $fetch_product['image']; ?>">
                                    <div>
                                        <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                        <p class="price"><?= $fetch_product['price']; ?>x<?= $fetch_cart['qty']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="empty"> your cart is empty!</p>';
                        }
                    }
                    ?>
                </div>
                <div class="grand-total"><span>total ammount payable:</span>$<?= $grand_total ?>/-</div>
            </div>
            <div class="row">
                <form action="" method="post">
                    <h3>billing detail</h3>
                    <div class="flex">
                        <div class="box">
                            <div class="input-field">
                                <p>your name <span>*</span>
                                </p>
                                <input type="text" name="name" required maxlength="50" placeholder="enter your name"
                                    class="input">
                            </div>
                            <div class="input-field">
                                <p>your number <span>*</span>
                                </p>
                                <input type="number" name="number" required maxlength="50"
                                    placeholder="enter your number" class="input">
                            </div>
                            <div class="input-field">
                                <p>your email<span>*</span>
                                </p>
                                <input type="email" name="email" required maxlength="50" placeholder="enter your email"
                                    class="input">
                            </div>
                            <div class="input-field">
                                <p>payment method <span>*</span>
                                </p>
                                <select name="method" class="input">
                                    <option value="cash on delivery">cash on delivery</option>
                                    <option value="credit or debit card">credit or debit card</option>
                                    <option value="net Banking">net Banking</option>
                                    <option value="UPI or Rupay">UPI or Rupay</option>
                                    <option value="paytm">paytm</option>


                                </select>
                            </div>
                            <div class="input-field">
                                <p>adress type <span>*</span>
                                </p>
                                <select name="adress_type" class="input">
                                    <option value="home">home</option>
                                    <option value="office">office</option>
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="input-field">
                                <p>adress line 01 <span>*</span>
                                </p>
                                <input type="text" name="flat" required maxlength="50"
                                    placeholder="e.g. flat & building" class="input">
                            </div>
                            <div class="input-field">
                                <p>adress line 02 <span>*</span>
                                </p>
                                <input type="text" name="street" required maxlength="50" placeholder="e.g. street name"
                                    class="input">
                            </div>
                            <div class="input-field">
                                <p>city name<span>*</span>
                                </p>
                                <input type="text" name="city" required maxlength="50" placeholder="e.g. city name"
                                    class="input">
                            </div>
                            <div class="input-field">
                                <p>country name<span>*</span>
                                </p>
                                <input type="text" name="country" required maxlength="50"
                                    placeholder="e.g. country name" class="input">
                            </div>
                            <div class="input-field">
                                <p>pincode<span>*</span>
                                </p>
                                <input type="text" name="pincode" required maxlength="6" min="0" max="999999"
                                    placeholder="e.g. 1251087" class="input">
                            </div>
                        </div>

                    </div>
                    <button type="submit" name="place_order" class="btn">place order</button>
            </div>
          
            </form>
        
            <?php include 'component/footer.php'; ?>
    </div>
    </section>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'component/alert.php'; ?>
</body>

</html>