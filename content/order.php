<?php
if (strtolower($rowLevel['level_name']) == 'leader') {
    header("location:home.php?access=denied");
    exit;
}

$queryOrder = mysqli_query($config, "SELECT o.*, c.customer_name FROM trans_orders AS o LEFT JOIN customers AS c ON o.id_customer = c.id WHERE o.deleted_at is NULL ORDER BY o.id DESC");
$rowOrders = mysqli_fetch_all($queryOrder, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_order = $_GET['delete'];
    mysqli_query($config, "UPDATE trans_orders SET deleted_at = NOW() WHERE id = '$id_order'");
    // mysqli_query($conn, "DELETE FROM order WHERE id = '$id_order'");
    header("location:?page=order&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Order</h5>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="?page=add-order" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>End Order</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowOrders as $rowOrder) { ?>
                                <tr>
                                    <td><a
                                            href="?page=add-order&detail=<?php echo $rowOrder['id']; ?>"><?php echo $rowOrder['order_code']; ?></a>
                                    </td>
                                    <td><?php echo $rowOrder['customer_name']; ?></td>
                                    <td><?php echo tanggal($rowOrder['order_date']); ?></td>
                                    <td><?php echo tanggal($rowOrder['order_end_date']); ?></td>
                                    <td><?php echo $rowOrder['order_status'] == 0 ? 'Process' : 'Picked Up'; ?></td>
                                    <td>
                                        <a href="print.php?id_order=<?php echo $rowOrder['id']; ?>"
                                            class="btn btn-success">Print</a>
                                        <a onclick="return alert('Are you sure?')"
                                            href="?page=order&delete=<?php echo $rowOrder['id']; ?>"
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