  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav mr-auto">
    <strong>E-SHOP ADMIN PAGE</strong>
  </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->

      <li class="nav-item dropdown btn btn-info rounded-circle">
        <a class="nav-link" data-toggle="dropdown" href="">
          <strong >
            <?=$_SESSION['user_name'] ?>
          </strong>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <a href="/admin/user/personal-info.php" class="dropdown-item">
          <i class="fas fa-user"></i> Personal's information
          </a>
          <a href="/admin/user/change-password.php" class="dropdown-item">
          <i class="fas fa-key"></i></i> Change password
          </a>
          <a href="/admin/logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Logout
          </a>

        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->