<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
$vnp_TmnCode = "AM9VD3UL"; //Website ID in VNPAY System
$vnp_HashSecret = "GMBTVDLUJSDNDOWWJUASLWXNMTCXLZJR"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://shopweb.com/app/payment-success.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.php";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
// $startTime = date("d/m/Y H:i:s");
// $expireTime = strtotime(str_replace('/', '-', $startTime)) + 15 * 60;
// $expire = date('d/m/Y H:i:s', $expireTime);

