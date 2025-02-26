<?php
include '../component/connection.php';


if(isset($_POST['register'])){
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['password'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = $_POST['cpassword'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $img_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../img/'.$image;

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
    $select_admin->execute([$email]);

    if ($select_admin->rowCount() >0){
        $warning_msg[] = 'user email already exists';
    }else{
        if($pass != $cpass){
            $warning_msg[] = 'confirmed password not matched';
        }else{
            $insert_admin = $conn->prepare("INSERT INTO `admin`(`id`, `name`, `email`, `password1`, `profie`) VALUES (?, ?, ?, ?, ?)");
            $insert_admin->execute([$id, $name, $email, $cpass, $image]);
            move_uploaded_file($img_tmp_name, $image_folder);
            $success_msg[] = 'new admin register';
        }
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
                    <h3>register now</h3>
                    <div class="input-field">
                        <label for="">user name<sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="enter name" oninput="this.value.replace(/\s/g, '')">
                    </div>
                    <div class="input-field">
                        <label for="">user email<sup>*</sup></label>
                        <input type="email" name="email" maxlength="20" required placeholder="enter email" oninput="this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label for="">user password<sup>*</sup></label>
                        <input type="password" name="password" maxlength="20" required placeholder="enter password" oninput="this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label for="">confirm password<sup>*</sup></label>
                        <input type="password" name="cpassword" maxlength="20" required placeholder="confirmed password" oninput="this.value.replace(/\s/g, '')">
                    </div>
                    <div class="input-field">
                        <label for="">select profie<sup>*</sup></label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit" name="register" class="btn">register now</button>
                    <p>already have an account ?<a href="login.php">login now</a></p>

                </form>

            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
    <?php include '../component/alert.php'; ?>
</body>
</html>