<?php
session_start();
include 'config.php';

if(!empty($_GET['ID'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM product_p WHERE ID='{$_GET['ID']}'");
    $result=mysqli_fetch_assoc($query_product);
    @unlink('upload_image/' . $result['profile_image']);

    $query = mysqli_query($conn, "DELETE FROM product_p WHERE ID='{$_GET['ID']}'") or die('query failed');
    mysqli_close($conn);

    if($query) {
        $_SESSION['message'] = 'Product Delete success';
        header('location: ' . $base_url . '/index.php');
    } else{
        $_SESSION['message'] = 'Product could not be delete!';
        header('location: ' . $base_url . '/index.php');
    }
}