<?php
session_start();
include 'config.php';

$now = date('Y-m-d H:i:s');
$query = mysqli_query($conn,"INSERT INTO orders(Order_date, fullname, email, tel, grand_total) VALUES ('{$now}', '{$_POST['fullname']}', '{$_POST['email']}', '{$_POST['tel']}', '{$_POST['grand_total']}')") or die('query failed');

if($query) {
    $last_ID = mysqli_insert_ID($conn);
    foreach($_SESSION['cart'] as $productIDs =>$productQty) {
        $product_name =$_POST['product'][$productIDs]['name'];
        $price = $_POST['product'][$productIDs]['price'];
        $total = $price * $productQty;

        mysqli_query ($conn,"INSERT INTO order_details(order_ID, product_ID, product_name, price, quantity, total)  VALUES ('{$last_ID}', '{$productIDs}', '{$product_name}', '{$price}', '{ $productQty}', '{$total}')") or die('query failed');
    }

    unset($_SESSION['cart']);
    $_SESSION['message'] = 'Checkout order success';
    header('location: ' . $base_url . '/checkout-success.php');
} else {
    $_SESSION['message'] = 'Checkout not complete!!';
    header('location: ' . $base_url . '/checkout-success.php');

}