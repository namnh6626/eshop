<?php
include_once 'connect.php';
include_once './includes/header.php';

if(isset($_POST['product']) && isset($_SESSION['customer_id'])){
	$productId = $_POST['product'];
    $quantity = $_POST['quantity'];
    $customer = $_SESSION['customer_id'];
    $size = $_POST['size'];
    // die($customer);
    $sql = "SELECT * FROM carts WHERE product_id = $productId AND customer_id = $customer AND size_id = $size";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        $addCartSql = "UPDATE carts SET quantity = quantity + $quantity WHERE product_id = $productId AND customer_id = $customer";
    }else{
        $addCartSql = "INSERT INTO carts(customer_id, product_id, quantity, size_id) VALUES ($customer, $productId, $quantity, $size)";

    }

    
    mysqli_query($conn, $addCartSql);

    header('location:cart.php');
}