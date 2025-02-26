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
            <h1>register Admin</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">home</a><span> / register Admin</span>
        </div>
        <section class="accounts">
            <h1 class="heading">register Admin</h1>
            <div class="box-container">
                <?php
                $select_admin = $conn->prepare("SELECT * FROM `admin`");
                $select_admin->execute();
                if($select_admin->rowCount()>0){
                    while($fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC)){
                        $admin_id = $fetch_admin['id'];
                ?>
                <div class="box">
                    <p>user id : <span><?= $admin_id;?></span></p>
                    <p>user name : <span><?= $fetch_admin['name'];?></span></p>
                    <p>user email : <span><?= $fetch_admin['email'];?></span></p>
                </div>
                <?php
                    }
                }else{
                    echo ' <div class="empty">
                <p>no admin registered yet !</p>
              </div>';
                }
                ?>
            </div>

        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
    <?php include '../component/alert.php'; ?>
</body>
</html>
