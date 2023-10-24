<?php
session_start();
include 'config.php';

if(!empty($_GET['ID'])) {
    unset($_SESSION['cart'][$_GET['ID']]);
    $_SESSION['message'] = 'Cart delete success';
}

header('location: ' . $base_url . '/cart.php');
