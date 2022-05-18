<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>


<?php include_once "../../app/connect.php";
include_once "../function.php";

$id = $_SESSION['user_id'];


$user = getUserInfo($conn, $id);
if (count($user) == 0) {
    header('location:/admin/404.php');
}else{
  $_SESSION['user_id'] =  $user['user_id'];
  $_SESSION['user_name'] = $user['user_name'];

  $_SESSION['user_email'] = $user['user_email'];
  $_SESSION['user_phone'] = $user['user_phone'];
  $_SESSION['role_id'] = $user['role_id'];
  $_SESSION['role_name'] = $user['role_name'];
}


if (isset($_POST['name'])) {

    $update = updateUser($conn, $id, $_POST['name'], $_POST['email'], $_POST['phone'], $_SESSION['role_id']);

    if ($update) {
        header("location:/admin/user/personal-info.php");
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
                            <h1>User's information</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/"><i class="fas fa-list"></i> Home</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User's information</li>
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
                                <form class="form-horizontal" action="/admin/user/personal-info.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">User name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="<?= $user['user_name'] ?>" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">User email</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="<?= $user['user_email'] ?>" name="email" class="form-control" id="" placeholder="Import price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="<?= $user['user_phone'] ?>" name="phone" class="form-control" id="" placeholder="Price">
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