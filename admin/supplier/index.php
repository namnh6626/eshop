<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php
include_once "../../app/connect.php";
include_once "../function.php";

$suppliers = getAllSuppliers($conn);



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
                            <h1>Suppliers</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/supplier/create.php">New supplier</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Suppliers</li>
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
                                    <h3 class="card-title">List suppliers</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Supplier Id</th>
                                                <th>Supplier Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($suppliers as $supplier) : ?>
                                                <tr>
                                                    <td><?= $supplier['supplier_id']  ?></td>
                                                    <td><?= $supplier['supplier_name']  ?></td>
                                                    <td><?= $supplier['phone']  ?></td>
                                                    <td><?= $supplier['address'] ?></td>
                                                    <td><a class="btn btn-info" href="/admin/supplier/edit.php?id=<?= $supplier['supplier_id'] ?>">Edit <i class="fas fa-edit"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Supplier Id</th>
                                                <th>Supplier Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Edit</th>

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