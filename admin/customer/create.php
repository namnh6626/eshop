
<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php include_once "../../app/connect.php";
include_once "../function.php";

$types = getAllProductTypes($conn);
$suppliers = getAllSuppliers($conn);
$sizes = getAllSizes($conn);

if (isset($_POST['name'])) {

    $productId = createProduct($conn, $_POST['name'], $_POST['import_price'], $_POST['price'], $_POST['image'], $_POST['supplier'], $_POST['type'], $_POST['description']);
    if (isset($productId)) {
        updateProductSizeQuantity($conn, $productId, $_POST['size'], $_POST['quantity']);
    }
    header("location:/admin/product/show.php?id=$productId");
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
                            <h1></h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/product"><i class="fas fa-list"></i> All products</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create new product</li>
                            </ol>
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

                                <form class="form-horizontal" action="/admin/product/create.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Product name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Product name" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Import price</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="import_price" class="form-control" id="" placeholder="Import price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="price" class="form-control" id="" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Image link</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="image" class="form-control" id="" placeholder="Link image">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Supplier</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="supplier" style="width: 100%;">
                                                    <?php foreach ($suppliers as $supplier) : ?>
                                                        <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="type" style="width: 100%;">
                                                    <?php foreach ($types as $type) : ?>
                                                        <option value="<?= $type['product_type_id'] ?>"><?= $type['product_type_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>





                                        <?php foreach ($sizes as $size) : ?>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label"><?= $size['size_name'] ?> size quantity</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" value="<?= $size['size_id'] ?>" class="form-control" name="size[]" id="">

                                                    <input type="number" class="form-control" name="quantity[]" id="" placeholder="<?= $size['size_name'] ?> size quantity" required min="0" step="1">
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="summernote" name="description" placeholder="Product description"></textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- /.card-body -->
                                    <div class="row d-flex justify-content-center my-2">
                                        <button type="submit" class="btn btn-info">Create</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->

                        <!--/.col (right) -->
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