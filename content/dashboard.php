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

$queryOrder = mysqli_query($config, "SELECT c.customer_name, o.* FROM trans_orders o LEFT JOIN customers c ON o.id_customer = c.id ORDER BY total DESC LIMIT 20");
$rowOrder = mysqli_fetch_all($queryOrder, MYSQLI_ASSOC);
?>

<div class="layout-demo-wrapper">
    <div class="layout-demo-placeholder">
        <img src="https://www.shutterstock.com/image-vector/woman-holding-sweaty-smelly-tshirt-600nw-1994394662.jpg"
            alt="Stinky Clothes" height="500" />
    </div>
    <div class="layout-demo-info">
        <h4>Stinky clothes make you nuasea?</h4>
        <p>Don't be lazy and go wash it at Londri!</p>
    </div>
</div>


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
                                        <h5 class="card-title" align="center">Account Login</h5>
                                        <div class="mb-3">
                                            <img src="https://www.shutterstock.com/image-vector/woman-holding-sweaty-smelly-tshirt-600nw-1994394662.jpg"
                                                alt="Stinky Clothes" width="50%" />
                                        </div>
                                        <div style="text-align: justify">
                                            Name : <?php echo $rowLogin['name']; ?><br>
                                            Level : <?php echo $rowLogin['level_name']; ?><br>
                                            Email : <?php echo $rowLogin['email']; ?><br>
                                            Login Date : <?php echo date('d F Y'); ?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                                <td><?php echo $data['total']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->
</div>