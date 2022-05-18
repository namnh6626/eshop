<?php
include_once('./includes/header.php');
include_once 'connect.php';
include_once 'function.php';
if(!isset($_SESSION['email'])){
	header('location:login.php');
}

if(isset($_POST['password'])){
    if(checkCustomerPassword($_SESSION['customer_id'], $_POST['password'], $conn)){
        if($_POST['new_password'] == $_POST['confirm_new_password']){
            $password = md5($_POST['new_password']);
            $customerId = $_SESSION['customer_id'];
            $sql = "UPDATE customers SET password = $password WHERE customer_id = $customerId";
            mysqli_query($conn, $sql);
            header('location:user-info.php');
        }else{
            $message = "New password and new password confirmation not match";
        }
    }else{
        $message = "Wrong current password";
    }
}


include_once './includes/menu.php';

?>

<section id="form" style="margin: auto;">
	<!--form-->
	<div class="container">

		<div class="row" style="display: flex; padding-bottom:40px;">

			<div class="col-sm-8" style="margin: 0 auto">
            <?php
				if (isset($message)) {
					echo "<div class='d-block alert alert-danger text-center'>$message</div>";
				}

				?>
				<div class="login-form">
					<!--login form-->
					<h2>Change password</h2>


					<form action="" method="POST">
                        <input type="password" name="password" placeholder="Current password" required>
						<input type="password" placeholder="New password"   name="new_password" required />
						<input type="password" placeholder="Confirm new password" name="confirm_new_password"  required />

						<button type="submit" class="btn btn-default">Change</button>
					</form>
				</div>
				<!--/login form-->
			</div>

			<!-- <div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div> -->

			<!-- <div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->


			<!-- <h2>New User Signup!</h2>
						<form action="#">
							<input type="text" placeholder="Name"/>
							<input type="email" placeholder="Email Address"/>
							<input type="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div> -->

			<!--/sign up form-->
		</div>
	</div>
	</div>
</section>
<!--/form-->


<?php include_once "./includes/footer.php"; ?>