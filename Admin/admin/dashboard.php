<?php
include '../component/connection.php';

session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)){
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <title>green cofee dashboard panel</title>
    <link rel="stylesheet" href="admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include '../component/admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>dashboard</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">home</a><span> / add products</span>
        </div>
        <section class="dashboard">
            <h1 class="heading">dashboard</h1>
            <div class="box-container">
                <div class="box">
                    <h3>welcome</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="" class="btn">profile</a>
                </div>
                <div class="box">
                    <?php
                    $select_product = $conn->prepare("SELECT * FROM `products`");
                    $select_product->execute();
                    $num_of_products = $select_product->rowCount();
                    ?>
                    <h3><?= $num_of_products;?></h3>
                    <p>product added</p>
                    <a href="add_products.php" class="btn">add new products</a>
                </div>
                <div class="box">
                    <?php
                    $select_active_product = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                    $select_active_product->execute(['active']);
                    $num_of_active_products = $select_active_product->rowCount();
                    ?>
                    <h3><?= $num_of_active_products;?></h3>
                    <p>total active product</p>
                    <a href="view_product.php" class="btn">view active products</a>
                </div>
                <div class="box">
                    <?php
                    $select_deactive_product = $conn->prepare("SELECT * FROM `products`");
                    $select_deactive_product->execute();
                    $num_of_deactive_products = $select_deactive_product->rowCount();
                    ?>
                    <h3><?=  $num_of_deactive_products;?></h3>
                    <p>view deactive products</p>
                    <a href="view_product.php" class="btn">view deactive product</a>
                </div>
                <div class="box">
                    <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $num_of_users = $select_users->rowCount();
                    ?>
                    <h3><?= $num_of_users;?></h3>
                    <p>registered users</p>
                    <a href="user_account.php" class="btn">view users</a>
                </div>
                <div class="box">
                    <?php
                    $select_admin = $conn->prepare("SELECT * FROM `admin`");
                    $select_admin->execute();
                    $num_of_admin = $select_admin->rowCount();
                    ?>
                    <h3><?= $num_of_admin;?></h3>
                    <p>registered Admin</p>
                    <a href="admin_account.php" class="btn">view admin</a>
                </div>
                <div class="box">
                    <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    $num_of_message = $select_message->rowCount();
                    ?>
                    <h3><?= $num_of_message;?></h3>
                    <p>unread message</p>
                    <a href="admin_message.php" class="btn">view message</a>
                </div>
                <div class="box">
                    <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    $num_of_orders = $select_orders->rowCount();
                    ?>
                    <h3><?= $num_of_orders;?></h3>
                    <p>total order placed</p>
                    <a href="order.php" class="btn">view orders</a>
                </div>
                <div class="box">
                    <?php
                    $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                    $select_confirm_orders->execute(['in progress']);
                    $num_of_confirm_order = $select_confirm_orders->rowCount();
                    ?>
                    <h3><?=  $num_of_confirm_order;?></h3>
                    <p>total confirmed order</p>
                    <a href="order.php" class="btn">view confirmed orders</a>
                </div>
                <div class="box">
                    <?php
                    $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                    $select_canceled_orders->execute(['in progress']);
                    $num_of_canceled_order =   $select_canceled_orders->rowCount();
                    ?>
                    <h3><?=  $num_of_canceled_order;?></h3>
                    <p>total canceled order</p>
                    <a href="order.php" class="btn">view canceled orders</a>
                </div>
               
            </div>

        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
    <?php include '../component/alert.php'; ?>
</body>
</html>
