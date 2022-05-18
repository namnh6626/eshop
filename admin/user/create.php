

<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>

<?php include_once "../../app/connect.php";
include_once "../function.php";

$roles = getAllUserRoles($conn);

if (isset($_POST['name'])) {

    $userId = createUser($conn, $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['role'], md5($_POST['password']));
    if (isset($productId)) {
        updateProductSizeQuantity($conn, $productId, $_POST['size'], $_POST['quantity']);
    }
    header("location:/admin/user/show.php?id=$productId");
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
                            <h1>Create new user</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/user"><i class="fas fa-list"></i> All users</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create new user</li>
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

                                <form class="form-horizontal" action="/admin/user/create.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">User name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="User name" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="email" class="form-control" id="" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="tel" name="phone" class="form-control" id="" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control" id="" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="role" style="width: 100%;">
                                                    <?php foreach ($roles as $role) : ?>
                                                        <?php if($role['role_id'] != 1):?>
                                                        <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
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