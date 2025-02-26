<?php
include '../component/connection.php';

session_start();
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['password'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);


    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password1 = ?");
    $select_admin->execute([$email, $pass]);

    if ($select_admin->rowCount() >0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        header('location:dashboard.php');
    }else{
        $warning_msg[] = 'incorect username or password';
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <title>green cofee admin panel</title>
    <link rel="stylesheet" href="admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="main">
        <section>
            <div class="form-container" id="admin_login">
                <form action="" class="" method="post" enctype="multipart/form-data">
                    <h3>login now</h3>
                   
                    <div class="input-field">
                        <label for="">user email<sup>*</sup></label>
                        <input type="email" name="email" maxlength="20" required placeholder="enter email" oninput="this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label for="">user password<sup>*</sup></label>
                        <input type="password" name="password" maxlength="20" required placeholder="enter password" oninput="this.value.replace(/\s/g, '')">
                    </div>

                    <button type="submit" name="login" class="btn">login now</button>
                    <p>ont have account ?<a href="register.php">register here</a></p>

                </form>

            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
    <?php include '../component/alert.php'; ?>
</body>
</html>