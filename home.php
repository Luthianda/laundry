<?php
include "config/koneksi.php";
ob_start();
session_start();

if (!($_SESSION['NAME'])) {
    header("location:index.php?access=denied");
}

function tanggal($d)
{
    $waktu = strtotime($d);
    return date('d F Y', $waktu);
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function formatKg($angka)
{
    $hasil_kg = $angka . " Kg";
    return $hasil_kg;
}
?>

<!doctype html>

<html lang="en" class="layout-menu-fixed layout-wide" data-assets-path="assets/assets/"
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

    <!-- Helpers -->
    <script src="assets/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="assets/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/header.php' ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <?php
                        if (isset($_GET['page'])) {
                            if (file_exists('content/' . $_GET['page'] . '.php')) {
                                include 'content/' . $_GET['page'] . '.php';
                            } else {
                                include 'content/notfound.php';
                            }
                        } else {
                            include 'content/dashboard.php';
                        }
                        ?>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

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
    <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>
</body>

</html>