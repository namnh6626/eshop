<?php
include_once "../app/connect.php";
include_once "../admin/function.php";

$currentMonth = intval(date('m'));
$currentYear = intval(date('Y'));

// echo gettype($currentMonth);
// die();
//last year
$revenue = [];
$lastRevenue = [];
for($i = 1; $i<=12; $i++){

    $lastRevenue[] = getBillsRevenueByMonth($conn, $i, $currentYear -1);
}

//current year
for($i = 1; $i <= 12 ; $i++){
    $revenue[] = getBillsRevenueByMonth($conn, $i, $currentYear);
}
// echo "<pre>";
// print_r($revenue);
if(isset($_GET['get']) ){
   
    $result = array_merge($revenue, $lastRevenue);
    echo json_encode($result);
}

if(isset($_GET['number'])){
    for($i = 1; $i<=12; $i++){

        $lastNumber[] = getTotalProductBillByMonth($conn, $i, $currentYear -1);
    }
    
    //current year
    for($i = 1; $i <= 12 ; $i++){
        $number[] = getTotalProductBillByMonth($conn, $i, $currentYear);
    }

    $numberOfProduct = array_merge($number, $lastNumber);
    echo json_encode($numberOfProduct);

}
