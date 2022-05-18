<?php

$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'eshop';


$conn  = mysqli_connect($host_name, $user_name, $password, $database);

if(!$conn){
    die('Failed: '.mysqli_connect_error());
}
// else{
//     echo('OK');
// }

// $encrypt = password_hash("123456", PASSWORD_BCRYPT); //encrypt password
// $verify = password_verify('1234', $encrypt); //verify password
// echo($verify);