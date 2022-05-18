<?php
if (isset($_SESSION['email'])) {
    $name = $_SESSION['name'];
    echo    "<li><div class='dropdown show'>
            <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <i class='fa fa-user'></i> $name
            </a>

            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                <a class='dropdown-item' style='display:block' href='user-info.php'>User's Information</a>
                <a class='dropdown-item' style='display:block' href='change-password.php'>Change password</a>
                <a class='dropdown-item' style='display:block' href='logout.php'>Logout</a>
            </div>
            </div></li>";
} else {
    echo    '<li><a href="register.php"><i class="fa fa-user"></i> Register</a></li> 
            <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
}
