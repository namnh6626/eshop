<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>


<?php include_once "../../app/connect.php";
include_once "../function.php";

$id = $_SESSION['user_id'];
$roles = getAllUserRoles($conn);




// echo $_SESSION['user_id'];
// die();


// echo '<pre>';
// print_r($sizeQuantities);
// die();

$user = getUserInfo($conn, $id);
if (count($user) == 0) {
    header('location:/admin/404.php');
}



if(isset($_POST['password'])){
    changeUserPassword($conn, $id, md5($_POST['password']));
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
                            <h1>Change password</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/user"><i class="fas fa-list"></i> Home</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Change password</li>
                            </ol>
                            
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
                                <form class="form-horizontal" action="/admin/user/change-password.php" method="POST">
                                    <div class="card-body">

                                    <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Current password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="current_password" class="form-control" id="" placeholder="New password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control" id="" placeholder="New password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="confirm_password" class="form-control" id="" placeholder="New password">
                                            </div>
                                        </div>


                                    </div>

                                    <!-- /.card-body -->
                                    <div class="row d-flex justify-content-center my-2">
                                        <button type="submit" class="btn btn-info">Change password</button>
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