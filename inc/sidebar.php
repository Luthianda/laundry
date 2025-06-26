<?php
$id_level = $_SESSION['ID_LEVEL'];
$queryLevel = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id_level'");
$rowLevel = mysqli_fetch_assoc($queryLevel);
// print_r($rowLevel);
// die;
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <img src="assets/assets/img/favicon/washing-machine.ico" alt="" width="20%" style="justify-content: center;">
        <!-- <a href="index.html" class="app-brand-link"> -->
        <span class="app-brand-text demo menu-text fw-bold ms-2">Londri</span>
        <!-- </a> -->

        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
        </a> -->
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="?page=dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Layouts -->
        <?php if (strtolower($rowLevel['level_name']) == 'administrator' || strtolower($rowLevel['level_name']) == 'operator') { ?>
            <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-slider"></i>
                    <div class="text-truncate" data-i18n="Layouts">Master Data</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="?page=customer" class="menu-link">
                            <div class="text-truncate" data-i18n="Without menu">Customer</div>
                        </a>
                    </li>
                    <!-- <?php if (strtolower($rowLevel['level_name']) == 'administrator') { ?> -->
                        <li class="menu-item">
                            <a href="?page=service" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Service</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="?page=level" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Level</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="?page=user" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">User</div>
                            </a>
                        </li>
                        <!-- <?php } ?> -->
                </ul>
            </li>
        <?php } ?>


        <?php if (strtolower($rowLevel['level_name']) == 'pimpinan') { ?>
            <li class="menu-item">
                <a href="?page=report" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div data-i18n="Report">Report</div>
                </a>
            </li>
        <?php } ?>

        <?php if (strtolower($rowLevel['level_name']) == 'administrator' || strtolower($rowLevel['level_name']) == 'operator') { ?>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Transaction</span>
            </li>
            <li class="menu-item">
                <a href="?page=order" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-basket"></i>
                    <div class="text-truncate" data-i18n="Email">Order</div>
                </a>
            </li>
        <?php } ?>

    </ul>
</aside>