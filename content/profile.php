<?php
$queryUser = mysqli_query($config, "SELECT * FROM users");
$countUser = mysqli_num_rows($queryUser);

$queryCustomer = mysqli_query($config, "SELECT * FROM customers");
$countCustomer = mysqli_num_rows($queryCustomer);

$queryService = mysqli_query($config, "SELECT * FROM type_of_services");
$countService = mysqli_num_rows($queryService);

$id = $_SESSION['ID_USER'];
$queryLogin = mysqli_query($config, "SELECT users.*, levels.level_name FROM users LEFT JOIN levels ON users.id_level = levels.id WHERE users.id = '$id'");
$rowLogin = mysqli_fetch_assoc($queryLogin);

$queryOrder = mysqli_query($config, "SELECT c.customer_name, o.* FROM trans_orders AS o LEFT JOIN customers AS c ON o.id_customer = c.id ORDER BY total DESC LIMIT 7");
$rowOrder = mysqli_fetch_all($queryOrder, MYSQLI_ASSOC);
?>

<div class="container-fluid flex-grow-1 container-p-y">
    <!-- Layout Demo -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" align="center">Dashboard</h3>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-center">
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title" align="center">Profile Picture</h5>
                                        <div class="mb-3">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpZh58zouK5AkI5aqcntMHqq883EUHHZmqKg&s"
                                                alt="cute cat" width="80%" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive mt-5">
                                <table class="table table-stripped">
                                    <tr>
                                        <th>Name</th>
                                        <td>:</td>
                                        <td><?php echo $rowLogin['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td>:</td>
                                        <td><?php echo $rowLogin['level_name']; ?></td>
                                    </tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?php echo $rowLogin['email']; ?></td>
                                    <tr>
                                        <th>Login Date</th>
                                        <td>:</td>
                                        <td><?php echo date('d F Y'); ?></td>
                                    </tr>
                                </table>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" align="center">Data Customer</h5>
                                                <h1 align="center"><?php echo $countCustomer; ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" align="center">Data Service</h5>
                                                <h1 align="center"><?php echo $countService; ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" align="center">Data User</h5>
                                                <h1 align="center"><?php echo $countUser; ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rowOrder as $key => $data) { ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $data['customer_name']; ?></td>
                                                <td><?php echo tanggal($data['order_date']); ?></td>
                                                <td><?php echo $data['order_status'] == 1 ? 'Pickup' : 'Process'; ?></td>
                                                <td><?php echo rupiah($data['total']); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Layout Demo -->
    </div>