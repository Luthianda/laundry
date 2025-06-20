<?php
$queryCostumer = mysqli_query($config, "SELECT * FROM customers WHERE deleted_at is NULL ORDER BY id DESC");
$rowCostumers = mysqli_fetch_all($queryCostumer, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_customer = $_GET['delete'];
    $now = date('Y-m-d H:i:s');
    mysqli_query($conn, "UPDATE customer SET deleted_at = '$now' WHERE id = '$id_customer'");
    // mysqli_query($conn, "DELETE FROM customer WHERE id = '$id_customer'");
    header("location:?page=customer&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Customer</h5>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="?page=add-customer" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowCostumers as $index => $rowCostumer) { ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $rowCostumer['customer_name']; ?></td>
                                    <td><?php echo $rowCostumer['phone']; ?></td>
                                    <td><?php echo $rowCostumer['address']; ?></td>
                                    <td>
                                        <a href="?page=add-customer&edit=<?php echo $rowCostumer['id']; ?>"
                                            class="btn btn-success">Edit</a>
                                        <a onclick="return alert('Are you sure?')"
                                            href="?page=customer&delete=<?php echo $rowCostumer['id']; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>