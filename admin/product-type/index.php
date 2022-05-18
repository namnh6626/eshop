
<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php
include_once "../../app/connect.php";
include_once "../function.php";

$types = getAllProductTypes($conn);


?>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <?php include_once "../includes/navbar.php" ?>

        <!-- Main Sidebar Container -->

        <?php include_once "../includes/sidebar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- <form action="" method="get">
        <input type="number" max='3'>
        <button type="submit">Ok</button>
      </form> -->

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Product types</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/product-type/create.php">New product type</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Product types</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">List product types</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type Id</th>
                                                <th>Type Name</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($types as $type) : ?>
                                                <tr>
                                                    <td><?= $type['product_type_id']  ?></td>
                                                    <td><?= $type['product_type_name']  ?></td>
                                                   
                                                    <td>
                                                        <?php if ($type['is_available_type']) : ?>
                                                            <span class="btn btn-success">Available</span>
                                                        <?php else : ?>
                                                            <span class="btn btn-dark">Removed</span>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><a class="btn btn-info" href="/admin/product-type/edit.php?id=<?= $type['product_type_id'] ?>">Edit <i class="fas fa-pen"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Type Id</th>
                                                <th>Type Name</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once "../includes/footer.php" ?>


    </div>


    <?php include_once "../includes/foot.php" ?>

</body>

</html>