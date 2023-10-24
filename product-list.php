<?php
session_start();
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM product_p"); 
$rows = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title> 

    <link href="<?php echo $base_url;?>/assets/css/bootstrap.min.css" rel="stylesheet" >
    <link href="<?php echo $base_url;?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet" >
    <link href="<?php echo $base_url;?>/assets/fontawesome/css/brands.min.css" rel="stylesheet" >
    <link href="<?php echo $base_url;?>/assets/fontawesome/css/solid.min.css" rel="stylesheet" >

</head>
<body class="bg-body-tertiary">
    <?php include 'include/menu.php'; ?>
    <div class="container" style="margin-top: 30px;">
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h4>Product List</h4>
        <!--แสดงรายการสินค้า-->
        <div class="row">
        <?php if($rows > 0): ?>
            <?php while($product = mysqli_fetch_assoc($query)): ?>

            <div class="col-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <?php if(!empty($product['profile_image'])): ?>
                        <img src="<?php echo  $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top" width="100" alt="Product Image"> 
                    <?php else: ?>
                        <img src="<?php echo  $base_url; ?>/assets/images/no-image.png" class="card-img-top" width="100" alt="Product Image"> 
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                        <p class="card-text text-success fw-bold mb-0"><?php echo number_format($product['price'], 2); ?>Baht</p>
                        <p class="card-text text-muted mb-0"><?php echo nl2br($product['detail']); ?></p>
                        <a href="<?php echo $base_url; ?>/cart-add.php?ID=<?php echo $product['ID']; ?>" class="btn btn-primary">Order</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <h4 class="text-danger">ไม่มีสินค้า</h4>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <link href="<?php echo $base_url;?>/assets/js/bootstrap.min.js" rel="stylesheet" >
</body>
</html> 
