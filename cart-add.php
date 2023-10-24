<?php
session_start();
include 'config.php';

if(!empty($_GET['ID'])) {
    if(empty($_SESSION['cart'][$_GET['ID']])) {
        $_SESSION['cart'][$_GET['ID']] = 1;
    } else {
        $_SESSION['cart'][$_GET['ID']] += 1;
    }

    $_SESSION['message'] = 'Cart add success';
}

header('location: ' . $base_url . '/product-list.php');
