<?php
$id_user = $_SESSION['ID_USER'];
$queryUser = mysqli_query($config, "SELECT users.name, levels.level_name FROM users LEFT JOIN levels ON users.id_level = levels.id WHERE users.id = '$id_user'");
$rowUser = mysqli_fetch_assoc($queryUser);
?>

<nav class="layout-navbar container-fluid navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center me-auto">
            <div class="nav-item d-flex align-items-center">
                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                    placeholder="Searchassets." aria-label="Searchassets." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-4">
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpZh58zouK5AkI5aqcntMHqq883EUHHZmqKg&s"
                            alt="cute cat" class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpZh58zouK5AkI5aqcntMHqq883EUHHZmqKg&s"
                                            alt="cute cat" class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0"><?php echo $rowUser['name']; ?></h6>
                                    <small class="text-body-secondary"><?php echo $rowUser['level_name']; ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="content/profile.php">
                            <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout.php">
                            <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>