<?php
include "config/koneksi.php";
session_start();
ob_start();

if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = sha1($_POST['password']);
  $query = mysqli_query($config, "SELECT * FROM users WHERE email = '$email' && password = '$password'");
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $_SESSION['NAME'] = $row['name'];
    $_SESSION['ID_USER'] = $row['id'];
    $_SESSION['ID_LEVEL'] = $row['id_level'];
    header("location:home.php");
    exit();
  } else {
    header("location:index.php?login=failed");
    exit();
  }
}

?>

<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="assets/assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Londri Web</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/assets/img/favicon/washing-machine.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="assets/assets/vendor/fonts/iconify-icons.css" />

  <!-- Core CSS -->
  <!-- build:css assets/vendor/css/theme.css  -->

  <link rel="stylesheet" href="assets/assets/vendor/css/core.css" />
  <link rel="stylesheet" href="assets/assets/css/demo.css" />

  <!-- Vendors CSS -->

  <link rel="stylesheet" href="assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- endbuild -->

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/assets/vendor/css/pages/page-auth.css" />

  <!-- Helpers -->
  <script src="assets/assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

  <script src="assets/assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->

            <!-- /Logo -->
            <h4 class="mb-1">Wash your stinky clothes here!</h4>
            <p class="mb-6">Please sign-in to your account to wash your clothes</p>

            <form id="formAuthentication" class="mb-6" method="post">
              <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                  autofocus />
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                  <a href="auth-forgot-password-basic.html">
                    <span>Forgot Password?</span>
                  </a>
                </div>
              </div>
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform?</span>
              <a href="auth-register-basic.html">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <div class="buy-now">
    <a href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/" target="_blank"
      class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
  </div>

  <!-- Core JS -->

  <script src="assets/assets/vendor/libs/jquery/jquery.js"></script>

  <script src="assets/assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/assets/vendor/js/bootstrap.js"></script>

  <script src="assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->

  <script src="assets/assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag before closing body tag for github widget button. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>