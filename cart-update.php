<?php
session_start();
include 'config.php';

foreach($_SESSION['cart'] as $productIDs => $productQty) {
    $_SESSION['cart'][$productIDs] = $_POST['product'][$productIDs]['quantity'];
}

$_SESSION['massage'] = 'Cart add success';
header('location: ' . $base_url . '/cart.php');
