<?php
if (strtolower($rowLevel['level_name']) != 'administrator') {
    header("location:home.php?access=denied");
    exit;
}

$queryLevel = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
$rowLevels = mysqli_fetch_all($queryLevel, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_level = $_GET['delete'];
    mysqli_query($config, "DELETE FROM levels WHERE id = '$id_level'");
    header("location:?page=level&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Level</h5>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="?page=add-level" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Level</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowLevels as $index => $rowLevel) { ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $rowLevel['level_name']; ?></td>
                                    <td>
                                        <a href="?page=add-level&edit=<?php echo $rowLevel['id']; ?>"
                                            class="btn btn-success">Edit</a>
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