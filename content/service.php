<?php
$queryService = mysqli_query($config, "SELECT * FROM type_of_services WHERE deleted_at is NULL ORDER BY id DESC");
$rowServices = mysqli_fetch_all($queryService, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_services = $_GET['delete'];
    mysqli_query($config, "UPDATE type_of_service SET deleted_at = NOW() WHERE id = '$id_services'");
    header("location:?page=services&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Type of Service</h5>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="?page=add-services" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowServices as $index => $rowService) { ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $rowService['service_name']; ?></td>
                                    <td><?php echo $rowService['price']; ?></td>
                                    <td><?php echo $rowService['description']; ?></td>
                                    <td>
                                        <a href="?page=add-services&edit=<?php echo $rowService['id']; ?>"
                                            class="btn btn-success">Edit</a>
                                        <a onclick="return alert('Are you sure?')"
                                            href="?page=services&delete=<?php echo $rowService['id']; ?>"
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