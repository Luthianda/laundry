<?php
if (strtolower($rowLevel['level_name']) == 'leader') {
    header("location:home.php?access=denied");
    exit;
}


$queryService = mysqli_query($config, "SELECT * FROM type_of_services WHERE deleted_at is NULL ORDER BY id DESC");
$rowServices = mysqli_fetch_all($queryService, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_services = $_GET['delete'];
    mysqli_query($config, "UPDATE type_of_services SET deleted_at = NOW() WHERE id = '$id_services'");
    header("location:?page=service&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Type of Service</h5>
                <div class="table-responsive">
                    <?php if (strtolower($rowLevel['level_name']) == 'administrator') { ?>
                        <div class="mb-3" align="right">
                            <a href="?page=add-service" class="btn btn-primary">Add</a>
                        </div>
                    <?php } ?>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <?php if (strtolower($rowLevel['level_name']) == 'administrator') { ?>
                                    <th></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowServices as $index => $rowService) { ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $rowService['service_name']; ?></td>
                                    <td><?php echo rupiah($rowService['price']); ?></td>
                                    <td><?php echo $rowService['description']; ?></td>
                                    <?php if (strtolower($rowLevel['level_name']) == 'administrator') { ?>
                                        <td>
                                            <a href="?page=add-service&edit=<?php echo $rowService['id']; ?>"
                                                class="btn btn-success">Edit</a>
                                            <a onclick="return alert('Are you sure?')"
                                                href="?page=service&delete=<?php echo $rowService['id']; ?>"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>