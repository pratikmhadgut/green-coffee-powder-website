<?php
include '../component/connection.php';

session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)){
    header('location: login.php');
}
// add product in database
if (isset($_POST['publish'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var( $content, FILTER_SANITIZE_STRING);

    $status = 'active';
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../img/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
    $select_image->execute([$image]);

    if (isset($image)){
        if ($select_image->rowCount()>0){
            $warning_msg[]= 'image name repeated';
        }elseif ($image_size >2000000){
            $warning_msg[]= 'image size is to large';
        }
        // change 25/02/2025
        // else{
        //     move_uploaded_file($img_tmp_name, $image_folder);
        // }
    }else{
        $image = '';
    }
    if ($select_image->rowCount() >0 AND $image != ''){
        $warning_msg[] = 'please rename your image';
    }else{
        $insert_product = $conn->prepare("INSERT INTO `products`(`id`, `name`, `price`, `image`, `product_detail`, `status`) VALUES (?, ?, ?, ?,?,?)");
        $insert_product->execute([$id, $name, $price,$image, $content, $status]);
        $success_msg[] = 'product inserted successfullly';
    }
}

//saved product in database as draft

// add product in database
if (isset($_POST['draft'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var( $content, FILTER_SANITIZE_STRING);

    $status = 'deactive';
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../img/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
    $select_image->execute([$image]);

    if (isset($image)){
        if ($select_image->rowCount()>0){
            $warning_msg[]= 'image name repeated';
        }elseif ($image_size > 2000000){
            $warning_msg[]= 'image size is to large';
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }
    if ($select_image->rowCount()>0 AND $image != ''){
        $warning_msg[] = 'please rename your image';
    }else{
        $insert_product = $conn->prepare("INSERT INTO `products`(`id`, `name`, `price`, `image`, `product_detail`, `status`) VALUES (?, ?, ?, ?,?,?)");
        $insert_product->execute([$id, $name, $price,$image, $content, $status]);
        $success_msg[] = 'product saved as draft successfullly';
    }
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
            <h1>add products</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">dashboard</a><span> / add products</span>
        </div>
        <section class="dashboard">
            <h1 class="heading">dashboard</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label for="">product name<sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="add product name">
                </div>
                <div class="input-field">
                    <label for="">product price<sup>*</sup></label>
                    <input type="number" name="price" maxlength="100" required placeholder="add product name">
                </div>
                <div class="input-field">
                    <label for="">product detail<sup>*</sup></label>
                    <textarea name="content" id="" required maxlength="10000" required placeholder="write product description"></textarea>
                </div>
                <div class="input-field">
                    <label for="">product image<sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">publish product</button>
                    <button type="submit" name="draft" class="btn">save as a draft </button>
                </div>
            </form>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
    <?php include '../component/alert.php'; ?>
</body>
</html>
