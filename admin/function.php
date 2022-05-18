<?php

function getAllProduct($conn)
{
    $sql = "SELECT DISTINCT * FROM products,product_types,suppliers where products.product_type_id = product_types.product_type_id and products.supplier_id = suppliers.supplier_id";

    // echo $sql;
    // die();
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}



function getAllUser($conn)
{
    $sql = "SELECT DISTINCT * FROM users,roles where users.role_id = roles.role_id";

    // echo $sql;
    // die();
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getProductTypeInfo($conn, $id)
{
    $sql = "SELECT * from product_types WHERE product_type_id = $id";
    $query = mysqli_query($conn, $sql);
    $result = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $result = $row;
    }
    return $result;
}

function getUserInfo($conn, $id)
{
    $sql = "SELECT * from users, roles WHERE user_id = $id AND users.role_id = roles.role_id";
    $query = mysqli_query($conn, $sql);
    $result = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $result = $row;
    }
    return $result;
}

function getAllProductTypes($conn)
{
    $sql = "SELECT * from product_types";
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getAllUserRoles($conn)
{
    $sql = "SELECT * from roles";
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}


function getAllSuppliers($conn)
{
    $sql = "SELECT * from suppliers";
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getAllSizes($conn)
{
    $sql = "SELECT * from sizes";
    $query = mysqli_query($conn, $sql);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function createProduct($conn, string $productName, int $importPrice, int $price, string $image, int $supplierId, int $typeId, $description)
{
    $sql = "INSERT INTO products(product_name, import_price, price, image, supplier_id, product_type_id, description)
            VALUES ('$productName', $importPrice, $price, '$image', $supplierId, $typeId, '$description')";

    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
}

function createSupplier($conn, string $name, string $address, string $phone)
{
    $sql = "INSERT INTO suppliers(supplier_name, address, phone)
            VALUES ('$name', $address, $phone)";

    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
}
function createUser($conn, string $name,  $email,  $phone, $roleId,  $password)
{
    $sql = "INSERT INTO users(user_name, user_email, user_phone, role_id, user_password)
            VALUES ('$name', $email, '$phone', $roleId, '$password')";

    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
}

function createRole($conn, string $roleName)
{
    $sql = "INSERT INTO roles(role_name)
            VALUES ('$roleName')";

    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
}

function createProductType($conn, string $typeName)
{
    $sql = "INSERT INTO product_types(product_type_name) VALUES ('$typeName')";
    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
}

function updateProductType($conn, int $typeId, string $typeName)
{
    $sql = "UPDATE product_types SET product_type_name = '$typeName' WHERE product_type_id = $typeId";

    // die($sql);
    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}

function insertProductSizeQuantity($conn, $productId, array $sizes, array $quantity)
{
    if (count($sizes) > 0) {
        $sql = "INSERT INTO product_size_quantities(product_id, size_id, product_size_quantity) VALUES ";
        for ($i = 0; $i < count($sizes); $i++) {
            $sql .= "($productId, $sizes[$i], $quantity[$i]),";
        }
        $sql = substr($sql, 0, -1);

        mysqli_query($conn, $sql);
    }
}
function updateProductSizeQuantity($conn, $productId, int $sizeId = 0, int $quantity = 0, bool $isSum = false)
{
    if ($sizeId == 0) {
        $sql = "UPDATE product_size_quantities SET product_size_quantity = 0 WHERE product_id = $productId ";
    } else {
        if ($isSum) {
            $sql = "UPDATE product_size_quantities SET product_size_quantity = product_size_quantity + $quantity WHERE product_id = $productId AND size_id = $sizeId";
        } else {
            $sql = "UPDATE product_size_quantities SET product_size_quantity = $quantity WHERE product_id = $productId AND size_id = $sizeId";
        }
    }
    mysqli_query($conn, $sql);
}

function getProductInfo($conn, $productId)
{
    $result = [];
    $sql = "SELECT DISTINCT * FROM products, suppliers, product_types 
            WHERE products.product_type_id = product_types.product_type_id 
            AND suppliers.supplier_id = products.supplier_id 
            AND product_id = $productId ";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);

        return $result;
    }
    return $result;
}

function getSupplierInfo($conn, $supplierId)
{
    $result = [];
    $sql = "SELECT DISTINCT * FROM suppliers 
            WHERE  supplier_id = $supplierId ";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);

        return $result;
    }
    return $result;
}

function getProductSizeQuantity($conn, $productId)
{
    $sql = "SELECT DISTINCT * FROM product_size_quantities,sizes 
            WHERE product_id = $productId 
            AND sizes.size_id = product_size_quantities.size_id";

    $result = [];
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }
    return [];
}


function updateProduct($conn, int $productId, string $productName, int $importPrice, int $price, string $image, int $supplierId, int $typeId, $description)
{
    $sql = "UPDATE products 
            SET product_name = '$productName', 
            import_price = $importPrice, 
            price = $price, 
            image = '$image', 
            supplier_id = $supplierId, 
            product_type_id = $typeId, 
            description = '$description'
            WHERE product_id = $productId";

    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}

function updateSupplier($conn, int $supplierId, string $name, string $phone, string $address)
{
    $sql = "UPDATE suppliers 
            SET supplier_name = '$name', 
            phone = $phone, 
            address = '$address'
           
            WHERE supplier_id = $supplierId";

    // die($sql);
    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}

function updateUser($conn, int $userId, string $userName, string $email, string $phone, int $role)
{
    $sql = "UPDATE users 
            SET user_name = '$userName', 
            user_email = '$email', 
            user_phone = $phone, 
            role_id = $role
            WHERE user_id = $userId";

    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}

function changeUserPassword($conn, int $userId, $password)
{
    $sql = "UPDATE users 
            SET user_password = $password
            WHERE user_id = $userId";

    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}


function searchProductSizeQuantities($conn, $productId, $sizeId)
{
    $sql = "SELECT * FROM product_size_quantities WHERE product_id = $productId AND size_id = $sizeId";
    // die($sql);
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function deleteRow($conn, $table, $column, $id)
{
    $sql = "DELETE FROM $table WHERE $column = $id";
    die($sql);

    mysqli_query($conn, $sql);
}

function removeOrRestoreProduct($conn, $productId, bool $isRemove)
{
    if ($isRemove) {
        $sql = "UPDATE products SET is_available = 0 WHERE product_id = $productId;";
    } else {
        $sql = "UPDATE products SET is_available = 1 WHERE product_id = $productId;";
    }
    // die($sql);

    mysqli_query($conn, $sql);
}

function removeOrRestoreUser($conn, $userId, bool $isActive)
{
    if ($isActive) {
        $sql = "UPDATE users SET is_active = 1 WHERE user_id = $userId;";
    } else {
        $sql = "UPDATE users SET is_active = 0 WHERE user_id = $userId;";
    }
    // die($sql);

    mysqli_query($conn, $sql);
}

function removeOrRestoreCustomer($conn, $customerId, bool $isRemove)
{
    if ($isRemove) {
        $sql = "UPDATE customers SET is_active = 0 WHERE customer_id = $customerId;";
    } else {
        $sql = "UPDATE customers SET is_active = 1 WHERE customer_id = $customerId;";
    }
    mysqli_query($conn, $sql);
}

function removeOrRestoreBill($conn, $billId, bool $isPaid)
{
    if ($isPaid) {
        $sql = "UPDATE bills SET is_paid = 1 WHERE bill_id = $billId;";
    } else {
        $sql = "UPDATE bills SET is_paid = 0 WHERE bill_id = $billId;";
    }
    mysqli_query($conn, $sql);
}


function getAllCustomer($conn)
{
    $sql = "SELECT * FROM customers";
    $result = [];
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getCustomerInfo($conn, $customerId)
{
    $sql = "SELECT * FROM customers WHERE customer_id = $customerId";
    $result = [];
    $query = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
    return $result;
}

function getAllBill($conn)
{
    $sql = "SELECT * FROM bills, customers WHERE bills.customer_id = customers.customer_id";
    $result = [];
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getBillInfo($conn, $billId)
{
    $result = [];
    $sql = "SELECT * FROM bills, customers 
            WHERE bills.customer_id = customers.customer_id
            AND bill_id = $billId";
    $query = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
    return $result;
}

function getVNPayInfo($conn, $billId)
{
    $result = [];
    $sql = "SELECT * FROM vn_pays
           WHERE bill_id = $billId";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
    return $result;
}


function getProductBillInfo($conn, $billId)
{
    $result = [];
    $sql = "SELECT * FROM bills, products, product_bills,sizes
            WHERE bills.bill_id = product_bills.bill_id
            AND product_bills.product_id = products.product_id
            AND product_bills.size_id = sizes.size_id
            AND bills.bill_id = $billId";

    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getProductBillPriceAndQuantity($conn, $billId)
{
    $result = [];
    $sql = "SELECT products.price, product_bills.quantity FROM bills, products, product_bills
            WHERE bills.bill_id = product_bills.bill_id
            AND product_bills.product_id = products.product_id
            AND bills.bill_id = $billId";

    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function getProductBillQuantity($conn, $billId)
{
    $result = [];
    $sql = "SELECT  product_bills.quantity FROM bills, products, product_bills
            WHERE bills.bill_id = product_bills.bill_id
            AND product_bills.product_id = products.product_id
            AND bills.bill_id = $billId";

    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    return $result;
}

function authAdmin($conn, $email, $password)
{
    $result = [];
    $password = md5($password);
    $sql = "SELECT * FROM users,roles WHERE users.role_id = roles.role_id AND user_email = '$email' AND user_password = '$password' AND is_active = 1 LIMIT 1";
    // die($sql);
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
    }
    return $result;
}

function getBillsRevenueByMonth($conn, $month, $year)
{
    $sql = "SELECT bill_id FROM bills WHERE MONTH(date_payment) = $month AND YEAR(date_payment) = $year";
    $result = [];
    $query = mysqli_query($conn, $sql);
    $total = 0;

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            
            $billInfo = getProductBillPriceAndQuantity($conn, $row['bill_id']);
            foreach($billInfo as $bill){
                $total += $bill['price'] * $bill['quantity'];
            }
           
            $row['total'] = $total;
            $result[] = $row;
        }
    }
    return $total;
}

function getTotalProductBillByMonth($conn, $month, $year)
{
    $sql = "SELECT bill_id FROM bills WHERE MONTH(date_payment) = $month AND YEAR(date_payment) = $year";
    $result = [];
    $query = mysqli_query($conn, $sql);
    $total = 0;

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            
            $billInfo = getProductBillQuantity($conn, $row['bill_id']);
            foreach($billInfo as $bill){
                $total +=  $bill['quantity'];
            }
           
            $row['total'] = $total;
            $result[] = $row;
        }
    }
    return $total;
}

function getBillsTotalByDate($conn, $start, $end)
{
    $sql = "SELECT bill_id FROM bills WHERE date_payment BETWEEN '$start' AND '$end'";
    $result = [];
    $query = mysqli_query($conn, $sql);
    $total = 0;

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            
            $billInfo = getProductBillPriceAndQuantity($conn, $row['bill_id']);
            foreach($billInfo as $bill){
                $total += $bill['price'] * $bill['quantity'];
            }
           
            $row['total'] = $total;
            $result[] = $row;
        }
    }
    return $total;
}

function getProductTotalByDate($conn, $start, $end)
{
    $sql = "SELECT bill_id FROM bills WHERE date_payment BETWEEN '$start' AND '$end'";
    $result = [];
    $query = mysqli_query($conn, $sql);
    $total = 0;

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            
            $billInfo = getProductBillPriceAndQuantity($conn, $row['bill_id']);
            foreach($billInfo as $bill){
                $total += $bill['quantity'];
            }
           
            $row['total'] = $total;
            $result[] = $row;
        }
    }
    return $total;
}

function getProductBestSelling($conn, $month)
{
    $sql = "SELECT  product_bills.product_id,product_name, sum(quantity) as tong FROM bills, products, product_bills
    WHERE bills.bill_id = product_bills.bill_id
    AND product_bills.product_id = products.product_id
    AND MONTH(date_payment) = $month
    GROUP BY product_name
    ORDER BY SUM(quantity) DESC
    LIMIT 1";

    $result = [];
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
    }
    return $result;
}