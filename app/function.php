<?php

// function productTypeMultiLevel(array $products, $parentId = 0, $level = 0){
//     $result = [];

//     foreach($products as $product){
//         if($product['parent_id'] == $parentId){
//             $product['level'] = $level;
//             $result[] = $product;
//             unset($products[$product['product_type_id']]);
//             $child = productTypeMultiLevel($products, $product['product_type_id'], $level + 1);
//             $result = array_merge($result, $child);
//         }
//     }
//     return $result;
// }

function getAllProductTypes($conn){
    $result = [];
    $sql = "SELECT * FROM product_types WHERE is_available_type = 1";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
    return $result;
}

function getAllSuppliers($conn){
    $suppliers = [];
    $sql = "SELECT * FROM suppliers";

    $query = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($query)){
        $suppliers[] = $row;
    }
    return $suppliers;
}

function getIndexProduct($count, $conn){
    $products = [];
    $sql = "SELECT * FROM products ORDER BY product_id DESC limit $count";
    $query = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($query)){
        $products[] = $row;
    }
    return $products;
}

function getCustomerInfo($customerId, $conn){
    
    $sql = "SELECT * FROM customers WHERE customer_id = $customerId";
    $query = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($query)){
        return $row;
    }
    
}

function checkIsExistCustomer($email, $conn){
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $query = mysqli_query($conn, $sql);

    // print_r($query);
    // echo $sql;
    if(mysqli_num_rows($query) > 0){
        return true;
    }
    return false;
}

function checkCustomerPassword($customerId, $passwordStr, $conn){
    $password = md5($passwordStr);
    $sql = "SELECT * FROM customers WHERE customer_id = $customerId AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        return true;
    }
    return false;
}

function insertBill($conn, array $product, array $quantity, array $size,$customerId, $paymentTime, $paymentMethod = 'VN_PAY'){
    $sqlBill = "INSERT INTO bills(customer_id, date_payment, payment_method) VALUES ($customerId, '$paymentTime', '$paymentMethod')";

    if(mysqli_query($conn, $sqlBill)){
        $billId = mysqli_insert_id($conn);
        
        $sqlProductBill = "INSERT INTO product_bills(bill_id, product_id, quantity, size_id) VALUES";
        for($i = 0; $i < count($product); $i++){
            $sqlProductBill .= "($billId, '$product[$i]', '$quantity[$i]', '$size[$i]')" . ",";

            updateProductQuantity($conn, $product[$i], $size[$i], $quantity[$i]);
        }
        $sqlProductBill = substr($sqlProductBill, 0, -1);

        mysqli_query($conn, $sqlProductBill);

        return $billId;
    }

    return false;

}

// require "connect.php";
// insertBill($conn, [35], [3], 1, '2022213204');

function insertVNPay($conn, $billId, $billCode, $tradingCode, $total, $bankCode){
    $sql = "INSERT INTO vn_pays(bill_id, vn_bill_code, trading_code, total, bank_code) VALUES ($billId, '$billCode', '$tradingCode', $total, '$bankCode')";
    mysqli_query($conn, $sql);
}

function updateProductQuantity($conn, $productId, $sizeId, $quantity){
    $sql = "UPDATE product_size_quantities SET product_size_quantity = product_size_quantity - $quantity where product_id = $productId and size_id = $sizeId";
    mysqli_query($conn, $sql);
}

function unsetCart($conn, $customerId){
    $sql = "DELETE FROM carts where customer_id = $customerId";
    mysqli_query($conn, $sql);
}

