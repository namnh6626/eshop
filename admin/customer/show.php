

<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php include_once "../../app/connect.php";
include_once "../function.php";


//remove
if (isset($_POST['delete_id'])) {
  $productId = $_POST['delete_id'];

  removeOrRestoreCustomer($conn, $_POST['delete_id'], 1);
  updateProductSizeQuantity($conn, $_POST['delete_id']);

  header("location:/admin/customer/show.php?id=$productId");
}

//restore
if (isset($_POST['restore_id'])) {
  $productId = $_POST['restore_id'];

  removeOrRestoreCustomer($conn, $_POST['restore_id'], 0);
  header("location:/admin/customer/show.php?id=$productId");
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  header('location:/admin/404.php');
}

$customer = getCustomerInfo($conn, $id);



if (count($customer) == 0) {
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
              <h1>Customer detail</h1>
              <div class="row mx-0">
                <a class="btn btn-primary" href="/admin/customer"><i class="fas fa-list"></i> All customers</a>

              </div>
            </div>
            <div class="col-sm-6">

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
                <li class="breadcrumb-item active">Customer detail</li>
              </ol>

              <div class="row d-flex justify-content-end" style="width: 100%; margin:0;">
                <?php if ($customer['is_active']) : ?>
                  <form action="/admin/customer/show.php?id=<?= $customer['customer_id'] ?>" method="post">
                    <input type="hidden" name="delete_id" value="<?= $customer['customer_id'] ?>">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Remove</button>
                  </form>

                <?php else : ?>
                  <form action="/admin/customer/show.php?id=<?= $customer['customer_id'] ?>" method="post">
                    <input type="hidden" name="restore_id" value="<?= $customer['customer_id'] ?>">
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
                      <span><?= $customer['name'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-10">
                      <span><?= $customer['email'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Phone</label>
                    <div class="col-sm-10">
                      <span>$<?= $customer['phone'] ?></span>
                    </div>
                  </div>
                  <div class="py-2 row border">
                    <label class="col-sm-2">Address</label>
                    <div class="col-sm-10">
                      <span><?= $customer['address'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Status</label>
                    <div class="col-sm-10">
                      <?php if ($customer['is_active']) : ?>
                        <span>Active</span>
                      <?php else : ?>
                        <span>Disable</span>
                      <?php endif; ?>
                    </div>
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