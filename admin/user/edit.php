<!DOCTYPE html>
<html lang="en">

<?php include_once "../includes/head.php" ?>


<?php include_once "../../app/connect.php";
include_once "../function.php";

$roles = getAllUserRoles($conn);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location:/admin/404.php');
}

// echo $_SESSION['user_id'];
// die();
if ($id == $_SESSION['user_id']) {
    header('location:/admin/user/personal-info.php');
}


// echo '<pre>';
// print_r($sizeQuantities);
// die();

$user = getUserInfo($conn, $id);
if (count($user) == 0) {
    header('location:/admin/404.php');
}

//remove
if(isset($_POST['delete_id'])){
    removeOrRestoreUser($conn, $_POST['delete_id'], 0);
    // updateProductSizeQuantity($conn, $_POST['delete_id']);
  
    header('location:/admin/user/');
  }
  
  //restore
  if(isset($_POST['restore_id'])){
    removeOrRestoreUser($conn, $_POST['restore_id'], 1);
    header("location:/admin/user/");
  }

if(isset($_POST['password'])){
    changeUserPassword($conn, $id, md5($_POST['password']));
}

if (isset($_POST['name'])) {

    $update = updateUser($conn, $id, $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['role']);

    if ($update) {
        header("location:/admin/user/");
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
                            <h1>Edit user</h1>
                            <div class="row mx-0">
                                <a class="btn btn-primary" href="/admin/user"><i class="fas fa-list"></i> All users</a>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit user</li>
                            </ol>
                            <div class="row d-flex justify-content-end" style="width: 100%; margin:0;">
                                <?php if ($user['is_active']) : ?>
                                    <form action="/admin/user/edit.php?id=<?= $user['user_id'] ?>" method="post">
                                        <input type="hidden" name="delete_id" value="<?= $user['user_id'] ?>">
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Disable</button>
                                    </form>

                                <?php else : ?>
                                    <form action="/admin/user/edit.php?id=<?= $user['user_id'] ?>" method="post">
                                        <input type="hidden" name="restore_id" value="<?= $user['user_id'] ?>">
                                        <button class="btn btn-warning" type="submit"><i class="fas fa-trash-restore"></i> Active</button>
                                    </form>
                                <?php endif; ?>

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
                                <form class="form-horizontal" action="/admin/user/edit.php?id=<?= $user['user_id'] ?>" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">User name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="<?= $user['user_name'] ?>" class="form-control" id="inputEmail3" placeholder="Product name" required>
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


                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="role" style="width: 100%;">
                                                    <option value="<?= $user['role_id'] ?>"><?= $user['role_name'] ?></option>
                                                    <?php foreach ($roles as $role) : ?>
                                                        <?php if ($role['role_id'] != $user['role_id']) : ?>
                                                            <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
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