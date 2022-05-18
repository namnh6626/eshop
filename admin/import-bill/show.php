<?php include_once "../../app/connect.php";
include_once "../function.php";

$sizes = getAllSizes($conn);

//remove
if(isset($_POST['delete_id'])){
  removeOrRestoreProduct($conn, $_POST['delete_id'], 1);
  // updateProductSizeQuantity($conn, $_POST['delete_id']);

  header('location:/admin/product/');
}

//restore
if(isset($_POST['restore_id'])){
  removeOrRestoreProduct($conn, $_POST['restore_id'], 0);
  header("location:/admin/product/");
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  header('location:/admin/404.php');
}

$product = getProductInfo($conn, $id);
$sizeQuantities = getProductSizeQuantity($conn, $id);
if(count($sizeQuantities) == 0){
  foreach($sizes as $size){
    $sizeQuantities[] = ['product_id'=>$_GET['id'],'size_id'=>$size['size_id'], 'product_size_quantity'=>0,'size_name'=>$size['size_name']];
  }
}

if(count($sizes) > count($sizeQuantities) && count($sizeQuantities) > 0){
  $result = [];
  foreach($sizeQuantities as $sizeQuantity){
    foreach($sizes as $size){
      if($size['size_id'] != $sizeQuantity['size_id']){
        $sizeQuantities[] = ['product_id'=>$_GET['id'],'size_id'=>$size['size_id'], 'product_size_quantity'=>0,'size_name'=>$size['size_name']];
      }
    }
  }
}
if (count($product) == 0) {
  header('location:/admin/404.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

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
              <h1>Product detail</h1>
              <div class="row mx-0">
                <a class="btn btn-primary" href="/admin/product"><i class="fas fa-list"></i> All products</a>
                <a class="btn btn-info mx-2" href="/admin/product/edit.php?id=<?= $product['product_id'] ?>"><i class="fas fa-pen"></i> Edit </a>

              </div>
            </div>
            <div class="col-sm-6">

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
                <li class="breadcrumb-item active">Product detail</li>
              </ol>

              <div class="row d-flex justify-content-end" style="width: 100%; margin:0;">
              <?php if($product['is_available']): ?>
               <form action="/admin/product/show.php?id=<?=$product['product_id'] ?>" method="post">
                 <input type="hidden" name="delete_id" value="<?=$product['product_id'] ?>">
                 <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Remove</button>
               </form>

              <?php else:?>
                <form action="/admin/product/show.php?id=<?=$product['product_id'] ?>" method="post">
                 <input type="hidden" name="restore_id" value="<?=$product['product_id'] ?>">
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
                    <label class="col-sm-2">Product name</label>
                    <div class="col-sm-10">
                      <span><?= $product['product_name'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Import price</label>
                    <div class="col-sm-10">
                      <span>$<?= $product['import_price'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Price</label>
                    <div class="col-sm-10">
                      <span>$<?= $product['price'] ?></span>
                    </div>
                  </div>
                  <div class="py-2 row border">
                    <label class="col-sm-2">Image link</label>
                    <div class="col-sm-10">
                      <span><?= $product['image'] ?></span>
                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Supplier</label>
                    <div class="col-sm-10">
                      <span><?= $product['supplier_name'] ?></span>

                    </div>
                  </div>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Type</label>
                    <div class="col-sm-10">
                      <span><?= $product['product_type_name'] ?></span>

                    </div>
                  </div>





                  <?php foreach ($sizeQuantities as $size) : ?>
                    <div class="py-2 row border">
                      <label class="col-sm-2"><?= $size['size_name'] ?> size quantity</label>
                      <div class="col-sm-10">
                        <span><?= $size['product_size_quantity'] ?></span>

                      </div>
                    </div>
                  <?php endforeach ?>

                  <div class="py-2 row border">
                    <label class="col-sm-2">Description</label>
                    <div class="col-sm-10">
                      <?= $product['description'] ?>
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