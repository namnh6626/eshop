<?php

require_once('./includes/header.php');
require_once('./includes/menu.php');

$sql = "SELECT * FROM product_types";
$query = mysqli_query($conn, $sql);
$productTypes = [];


foreach ($query as $type) {
    $productTypes[] = $type;
}

if(isset($_POST['product'][0])){
    $total = 0;
    for($i = 0; $i < count($_POST['product']); $i++){
        $total += $_POST['price'][$i] * $_POST['quantity'][$i];
    }
    $_SESSION['bill']['product'] = $_POST['product'];
    $_SESSION['bill']['quantity'] = $_POST['quantity'];
    $_SESSION['bill']['size'] = $_POST['size'];

}else{
    header('location:cart.php');
}
?>


<body>


    <body>
        <?php require_once("./vn_pay/config.php"); ?>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">PAYMENT</h3>
            </div>
            <!-- <h3>CREATE PAYMENT</h3> -->
            <div class="table-responsive">
                <form action="/app/vn_pay/vnpay_create_payment.php" id="create_form" method="post">

                    <div class="form-group">
                        <!-- <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="topup">Nạp tiền điện thoại</option>
                            <option value="billpayment">Thanh toán hóa đơn</option>
                            <option value="fashion">Thời trang</option>
                            <option value="other">Khác - Xem thêm tại VNPAY</option>
                        </select> -->
                        <input type="hidden" name="order_type" value="billpayment">
                    </div>

                    <div class="form-group">
                        <label style="width:160px;">Name (*)</label>
                        <span><?php echo strtoupper($_SESSION['name']) ?></span>

                        <input class="form-control" id="txt_billing_fullname" name="txt_billing_fullname" type="hidden" value="<?php echo strtoupper($_SESSION['name']) ?>" />
                    </div>
                    <div class="form-group">
                        <label style="width:160px;">Email (*)</label>
                        <input class="form-control" id="txt_billing_email" name="txt_billing_email" type="hidden" value="<?php echo ($_SESSION['email']) ?>" />
                        <span><?php echo ($_SESSION['email']) ?></span>
                    </div>
                    <div class="form-group">
                        <label style="width:160px;">Phone (*)</label>
                        <span><?php echo ($_SESSION['phone']) ?></span>
                        <input class="form-control" id="txt_billing_mobile" name="txt_billing_mobile" type="hidden" value="<?php echo ($_SESSION['phone']) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="order_id" style="width:160px;">Bill ID</label>
                        <span><?php echo date("YmdHis") . "VN_PAY" . $_SESSION['customer_id'] ?></span>
                        <input class="form-control" id="order_id" name="order_id" type="hidden" value="<?php echo date("YmdHis") . "VN_PAY" . $_SESSION['customer_id'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="amount" style="width:160px;">Amount</label>
                        <span>$<?php echo number_format($total); ?></span>
                        <input class="form-control" id="amount" name="amount" type="hidden" value="<?php echo ($total * 23000); ?>" />
                    </div>
                    <div class="form-group">
                        <!-- <label for="order_desc" style="width:160px;">Content billing</label> -->

                        <textarea style="display: none;" class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Shopweb.com payment</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Bank</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Not selected</option>
                            <option value="NCB"> NCB</option>
                            <option value="AGRIBANK"> Agribank</option>
                            <option value="SCB"> SCB</option>
                            <option value="SACOMBANK"> SacomBank</option>
                            <option value="EXIMBANK"> EximBank</option>
                            <option value="MSBANK"> MSBANK</option>
                            <option value="NAMABANK"> NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK"> Vietinbank</option>
                            <option value="VIETCOMBANK"> VCB</option>
                            <option value="HDBANK"> HDBank</option>
                            <option value="DONGABANK"> Dong A</option>
                            <option value="TPBANK"> TPBank</option>
                            <option value="OJB"> OceanBank</option>
                            <option value="BIDV"> BIDV</option>
                            <option value="TECHCOMBANK"> Techcombank</option>
                            <option value="VPBANK"> VPBank</option>
                            <option value="MBBANK"> MBBank</option>
                            <option value="ACB">ACB</option>
                            <option value="OCB"> OCB</option>
                            <option value="IVB">IVB</option>
                            <option value="VISA"> VISA/MASTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select> -->
                        <input type="hidden" name="language" value="en">
                    </div>
                    <div class="form-group">
                        <label style="width:160px;">Payment period</label>
                        <span><?php echo date('d/m/Y H:i:s', strtotime($expire)); ?></span>
                        <input class="form-control" id="txtexpire" name="txtexpire" type="hidden" value="<?php echo $expire; ?>" />
                    </div>
                    <!-- <div class="form-group">
                        <h3>Thông tin hóa đơn (Billing)</h3>
                    </div> -->
                    
                    <div class="form-group">
                        <label style="width:160px;">Address (*)</label>
                        <span><?php echo ($_SESSION['address']) ?></span>
                        <input class="form-control" id="txt_billing_addr1" name="txt_billing_addr1" type="hidden" value="<?php echo ($_SESSION['address']) ?>" />
                    </div>
                    <div class="form-group">
                        <!-- <label style="width:160px;">Post code (*)</label> -->
                        <input class="form-control" id="txt_postalcode" name="txt_postalcode" type="hidden" value="100000" />
                    </div>
                    <div class="form-group">
                        <!-- <label style="width:160px;">Province/City (*)</label> -->
                        <input class="form-control" id="txt_bill_city" name="txt_bill_city" type="hidden" value="Ha Noi" />
                    </div>
                    <!-- <div class="form-group">
                        <label>Bang (Áp dụng cho US,CA)</label>
                        <input class="form-control" id="txt_bill_state" name="txt_bill_state" type="text" value="" />
                    </div> -->
                    <div class="form-group">
                        <!-- <label style="width:160px;">Country (*)</label> -->
                        <input class="form-control" id="txt_bill_country" name="txt_bill_country" type="hidden" value="VN" />
                  


                    <input class="form-control" id="txt_inv_customer" name="txt_inv_customer" type="hidden" value="Lê Văn Phổ" />
                    <input class="form-control" id="txt_inv_company" name="txt_inv_company" type="hidden" value="Công ty Cổ phần giải pháp Thanh toán Việt Nam" />
                    <input class="form-control" id="txt_inv_addr1" name="txt_inv_addr1" type="hidden" value="22 Láng Hạ, Phường Láng Hạ, Quận Đống Đa, TP Hà Nội" />
                    <input class="form-control" id="txt_inv_taxcode" name="txt_inv_taxcode" type="hidden" value="0102182292" />
                    <input type="hidden" name="cbo_inv_type" value="I">
                    <input class="form-control" id="txt_inv_email" name="txt_inv_email" type="hidden" value="pholv@vnpay.vn" />
                    <input class="form-control" id="txt_inv_mobile" name="txt_inv_mobile" type="hidden" value="02437764668" />


                    
                        <!-- <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán Post</button> -->
                        <button type="submit" name="redirect" id="redirect" class="btn btn-primary">Confirm</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY <?php echo date('Y') ?></p>
            </footer>
        </div>




    </body>

    <?php include_once "./includes/footer.php"; ?>