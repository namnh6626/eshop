<?php
    include_once "constant.php";
    if($_SESSION['role_id'] != SUPPER_ADMIN_ID){
        header('location:/admin/');
    }

?>