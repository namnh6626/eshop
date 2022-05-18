<?php 
include_once 'connect.php';
include_once './includes/header.php';

if(isset($_GET['id'])){
    $productId = $_GET['id'];
    $size = $_GET['size'];
    $customerId = $_SESSION['customer_id'];
    $sql = "DELETE FROM carts WHERE customer_id = $customerId AND product_id = $productId AND size_id = $size";
    // die($sql);
    mysqli_query($conn, $sql);
    header('location:cart.php');
}else{
    header('location:index.php');
}