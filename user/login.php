<?php  include 'component/connection.php';
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
//register user
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

     $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? ");
     $select_user->execute([$email,$pass]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
     if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        header('location:home.php');
     }else{
        $message[] = 'incorrect username or password';

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
    <title>green tea-register now</title>
</head>
<body>
   <div class="main-container">
    <section class="form-container">
        <div class="title">
            <img src="img/download.png" alt="">
            <h1>login  now</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita praesentium quia esse, cum illo neque ratione numquam blanditiis fugit cupiditate, sunt nulla sequi deserunt ipsa rerum minus quam dignissimos? Ipsa.</p>

        </div>
        <form action="" method="post">
            
            <div class="input-field">
                <p>your email:</p>
                <input type="email" name="email" required placeholder="enter your email" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
            <div class="input-field">
                <p>your password:</p>
                <input type="password" name="pass" required placeholder="enter your password" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            </div>
           
            <input type="submit" name="submit" value="login now" class="btn">
            <p>do not have account? have an account? <a href="register.php">register now</a></p>
        </form>
    </section>
   </div> 
</body>
</html>