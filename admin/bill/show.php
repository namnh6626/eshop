<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>


<?php include_once "../../app/connect.php";
include_once "../function.php";
include_once "../constant.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  header('location:/admin/404.php');
}
//remove
if (isset($_POST['delete_id'])) {
  removeOrRestoreBill($conn, $_POST['delete_id'], 0);

  header("location:/admin/bill/show.php?id=$id");
}

//restore
if (isset($_POST['restore_id'])) {
  removeOrRestoreBill($conn, $_POST['restore_id'], 1);
  header("location:/admin/bill/show.php?id=$id");
}



$bill = getBillInfo($conn, $id);
$productBill = getProductBillInfo($conn, $id);


if($bill['payment_method'] == VN_PAY_METHOD){
  $vnPay = getVNPayInfo($conn, $id);
}

if (count($bill) == 0) {
  header('location:/admin/404.php');
}

?>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <?php include_once "../includes/navbar.php" ?>

    <!-- Main Sidebar Container -->

    <?php include_once "../includes/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Bill detail</h1>
              <div class="row mx-0">
                <a class="btn btn-primary" href="/admin/bill"><i class="fas fa-list"></i> All bills</a>
                <a class="btn btn-info mx-2" href="/admin/bill/edit.php?id=<?= $bill['bill_id'] ?>"><i class="fas fa-pen"></i> Edit </a>

              </div>
            </div>
            <div class="col-sm-6">

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
                <li class="breadcrumb-item active">Bill detail</li>
              </ol>

              <div class="row d-flex justify-content-end" style="width: 100%; margin:0;">
                <?php if ($bill['is_paid']) : ?>
                  <form action="/admin/bill/show.php?id=<?= $bill['bill_id'] ?>" method="post">
                    <input type="hidden" name="delete_id" value="<?= $bill['bill_id'] ?>">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Remove</button>
                  </form>

                <?php else : ?>
                  <form action="/admin/bill/show.php?id=<?= $bill['bill_id'] ?>" method="post">
                    <input type="hidden" name="restore_id" value="<?= $bill['bill_id'] ?>">
                    <button class="btn btn-warning" type="submit"><i class="fas fa-trash-restore"></i> Restore</button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">

              <!-- Horizontal Form -->
              <div class="card card-info">

                <div class="card-body">
                  <div class="py-2 row border">
                    <label class="col-sm-2">Customer name</label>
                    <div class="col-sm-10">
                      <span><a href="/admin/customer/show.php?id=<?= $bill['customer_id'] ?>"><?= $bill['name'] ?></a> </span>
                    </div>
                  </div>
                  <div class="py-2 row border">
                    <label class="col-sm-2">Customer phone</label>
                    <div class="col-sm-10">
                      <span><?= $bill['phone'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Date payment</label>
                    <div class="col-sm-10">
                      <span><?= date("d/m/Y H:i:s", strtotime($bill['date_payment'])) ?></span>
                    </div>
                  </div>

                  <?php if(count($vnPay) > 0): ?>
                  <div class="py-2 row border">
                    <label class="col-sm-2">VN Pay bill code</label>
                    <div class="col-sm-10">
                      <span><?= $vnPay['vn_bill_code'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">VN Pay trading code</label>
                    <div class="col-sm-10">
                      <span><?= $vnPay['trading_code'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">VN Pay bank code</label>
                    <div class="col-sm-10">
                      <span><?= $vnPay['bank_code'] ?></span>
                    </div>
                  </div>
                  <?php endif;?>

                </div>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">List products</h3>
                  </div>
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Into money</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sum = 0;
                        foreach ($productBill as $product) : ?>
                          <tr>
                            <td> <a href="/admin/product/show.php?id=<?= $product['product_id']  ?>"><?= $product['product_name']  ?></a> </td>
                            <td><?= $product['size_name']  ?></td>
                            <td data-order="<?= $product['price']  ?>">$<?= $product['price']  ?></td>

                            <td><?= $product['quantity']  ?></td>
                            <td>$<?= number_format($product['price'] * $product['quantity']) ?></td>
                            <?php $sum += $product['price'] * $product['quantity']; ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Total</th>
                          <th>$<?= number_format($sum) ?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                </div>

              </div>


            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once "../includes/footer.php" ?>


  </div>


  <?php include_once "../includes/foot.php" ?>

</body>

</html>