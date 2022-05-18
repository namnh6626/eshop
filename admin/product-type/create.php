

<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php include_once "../../app/connect.php";
include_once "../function.php";

$types = getAllProductTypes($conn);


if (isset($_POST['name'])) {

    $isNotExistType = true;
    foreach ($types as $type) {
        if (strtoupper($type['product_type_name']) == strtoupper($_POST['name'])) {
            $isNotExistType = false;
        }
    }

    if ($isNotExistType) {
        $productTypeId = createProductType($conn, strtoupper($_POST['name']));
        if (isset($productTypeId)) {
            header("location:/admin/product-type/show.php?id=$productTypeId");
        }
        $message = "Some thing went wrong!";
    } else {
        $message = "Type name already existed!";
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
                            <h1>Create new product type</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/product"><i class="fas fa-list"></i> All product types</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create new product type</li>
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
                                <?php if (isset($message)) : ?>

                                    <div class='d-block alert alert-danger text-center'><?= $message ?></div>
                                <?php endif; ?>
                                <form class="form-horizontal" action="/admin/product-type/create.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Product type name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" placeholder="Product name" required>
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