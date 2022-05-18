<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php include_once "../../app/connect.php";
include_once "../function.php";

$types = getAllProductTypes($conn);
$suppliers = getAllSuppliers($conn);
$sizes = getAllSizes($conn);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {

    header('location:/admin/404.php');
}

$product = getProductInfo($conn, $id);
$sizeQuantities = getProductSizeQuantity($conn, $id);
if (count($sizeQuantities) == 0) {
    foreach ($sizes as $size) {
        $sizeQuantities[] = ['product_id' => $_GET['id'], 'size_id' => $size['size_id'], 'product_size_quantity' => 0, 'size_name' => $size['size_name']];
    }
}

if (count($sizes) > count($sizeQuantities) && count($sizeQuantities) > 0) {
    $result = [];
    foreach ($sizeQuantities as $sizeQuantity) {
        foreach ($sizes as $size) {
            if ($size['size_id'] != $sizeQuantity['size_id']) {
                $sizeQuantities[] = ['product_id' => $_GET['id'], 'size_id' => $size['size_id'], 'product_size_quantity' => 0, 'size_name' => $size['size_name']];
            }
        }
    }
}
// echo '<pre>';
// print_r($sizeQuantities);
// die();

if (count($product) == 0) {
    header('location:/admin/404.php');
}

if (isset($_POST['name'])) {

    $update = updateProduct($conn, $id, $_POST['name'], $_POST['import_price'], $_POST['price'], $_POST['image'], $_POST['supplier'], $_POST['type'], $_POST['description']);

    $quantities = $_POST['quantity'];

    $sizes = $_POST['size'];


    for ($i = 0; $i < count($quantities); $i++) {
        if (searchProductSizeQuantities($conn, $_GET['id'], $sizes[$i])) {
            updateProductSizeQuantity($conn, $_GET['id'], $sizes[$i], $quantities[$i]);
        } else {
            insertProductSizeQuantity($conn, $_GET['id'], [$sizes[$i]], [$quantities[$i]]);
        }
    }


    if ($update) {
        header("location:/admin/product/show.php?id=$id");
    } else {
        $err = "Something went wrong!!";
    }
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
                            <h1>Edit product</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/product"><i class="fas fa-list"></i> All products</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit product</li>
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
                                <?php
                                if (isset($err)) {
                                    echo "<span class= ''>$err</span>";
                                }
                                ?>
                                <form class="form-horizontal" action="/admin/product/edit.php?id=<?= $product['product_id'] ?>" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Product name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="<?= $product['product_name'] ?>" class="form-control" id="inputEmail3" placeholder="Product name" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Import price</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="<?= $product['import_price'] ?>" name="import_price" class="form-control" id="" placeholder="Import price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="<?= $product['price'] ?>" name="price" class="form-control" id="" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Image link</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $product['image'] ?>" name="image" class="form-control" id="" placeholder="Link image">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="type" style="width: 100%;">
                                                    <option value="<?= $product['product_type_id'] ?>"><?= $product['product_type_name'] ?></option>
                                                    <?php foreach ($types as $type) : ?>
                                                        <?php if ($type['product_type_id'] != $product['product_type_id']) : ?>
                                                            <option value="<?= $type['product_type_id'] ?>"><?= $type['product_type_name'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Supplier</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="supplier" style="width: 100%;">
                                                    <option value="<?= $product['supplier_id'] ?>"><?= $product['supplier_name'] ?></option>

                                                    <?php foreach ($suppliers as $supplier) : ?>
                                                        <?php if ($supplier['supplier_id'] != $product['supplier_id']) : ?>
                                                            <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>





                                        <?php foreach ($sizeQuantities as $size) : ?>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label"><?= $size['size_name'] ?> size quantity</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" value="<?= $size['size_id'] ?>" class="form-control" name="size[]" id="">

                                                    <input type="number" value="<?= $size['product_size_quantity'] ?>" class="form-control" name="quantity[]" id="" required min="0" step="1">
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="summernote" name="description" placeholder="Product description"><?= $product['description'] ?></textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- /.card-body -->
                                    <div class="row d-flex justify-content-center my-2">
                                        <button type="submit" class="btn btn-info">Update</button>
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