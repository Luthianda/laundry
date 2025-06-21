<?php
    $selectOrder = mysqli_query($conn, "SELECT order_date FROM trans_order ORDER BY order_date");
    $rowOrder = mysqli_fetch_all($selectOrder, MYSQLI_ASSOC);
    $len = mysqli_num_rows($selectOrder);
    $date_min = $rowOrder[0]['order_date'];
    $date_max = $rowOrder[$len - 1]['order_date'];

    if (isset($_POST['filter'])) {
        $start = $_POST['date_start'];
        $end = $_POST['date_end'];
    } else {
        $start = $date_min;
        $end = $date_max;
    }

    $q = mysqli_query($conn, "SELECT c.customer_name, o.order_date, s.service_name, od.qty, s.price, od.subtotal
    FROM trans_order_detail od
    LEFT JOIN type_of_service s ON od.id_service = s.id
    LEFT JOIN trans_order o ON od.id_order = o.id
    LEFT JOIN customer c ON o.id_customer = c.id
    WHERE o.order_date BETWEEN '$start' AND '$end'
    ORDER BY od.id, o.total DESC
    ");

    $r = mysqli_fetch_all($q, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report Transaction Order</h5>
                <div class="table-responsive">
                    <div class="mb-3">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date Start</label>
                                    <input type="date" name="date_start" class="form-control" value="<?php echo $start; ?>" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date End</label>
                                    <input type="date" name="date_end" class="form-control" value="<?php echo $end; ?>" required>
                                </div>
                                <div class="col-sm-3 mt-8">
                                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($r as $row) : ?>
                                <tr>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo tanggal($row['order_date']); ?></td>
                                    <td><?php echo $row['service_name']; ?></td>
                                    <td><?php echo formatKg($row['qty']/1000); ?></td>
                                    <td><?php echo rupiah($row['price']); ?></td>
                                    <td><?php echo rupiah($row['subtotal']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>