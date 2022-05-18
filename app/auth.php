<?php
session_start();
require_once('connect.php');

if(isset($_POST['email'])){
    // echo $_POST['email'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM customers WHERE email ='$email' AND password = '$password' AND is_active = 1";
    // echo $sql;
    $data = mysqli_query($conn, $sql);
    
    // echo('<pre>');
    // print_r($data);
    // echo('</pre>');

    if(mysqli_num_rows($data) > 0){
        $customer = mysqli_fetch_assoc($data);
        
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $customer['name'];
        $_SESSION['customer_id'] = $customer['customer_id'];
        $_SESSION['phone'] = $customer['phone'];
        $_SESSION['address'] = $customer['address'];

        if(isset($_SESSION['login_failed'])){
            unset($_SESSION['login_failed']);
        }

        header('location:index.php');

    }else{
        header('location:login.php');
        $_SESSION['login_failed'] = 1;
    }
}