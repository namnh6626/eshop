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




$supplier = getSupplierInfo($conn, $id);
if (count($supplier) == 0) {
    header('location:/admin/404.php');
}

if (isset($_POST['name'])) {

    $update = updateSupplier($conn, $id, $_POST['name'], $_POST['phone'], $_POST['address']);

    if ($update) {
        header("location:/admin/supplier");
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
                            <h1>Edit supplier</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/supplier"><i class="fas fa-list"></i> All suppliers</a>

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
                                <form class="form-horizontal" action="/admin/supplier/edit.php?id=<?= $supplier['supplier_id'] ?>" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Supplier name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="<?= $supplier['supplier_name'] ?>" class="form-control" id="inputEmail3" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="tel" value="<?= $supplier['phone'] ?>" name="phone" class="form-control" id="" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $supplier['address'] ?>" name="address" class="form-control" >
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