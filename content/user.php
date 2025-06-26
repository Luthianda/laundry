<?php
if (strtolower($rowLevel['level_name']) != 'administrator') {
    header("location:home.php?access=denied");
    exit;
}

$queryUser = mysqli_query($config, "SELECT users.*, levels.level_name FROM users LEFT JOIN levels ON users.id_level = levels.id ORDER BY users.id DESC");
$rowUsers = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    mysqli_query($config, "DELETE FROM users WHERE id = '$id_user'");
    header("location:?page=user&remove=success");
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data User</h5>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="?page=add-user" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowUsers as $index => $rowUser) { ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $rowUser['name']; ?></td>
                                    <td><?php echo $rowUser['email']; ?></td>
                                    <td><?php echo $rowUser['level_name']; ?></td>
                                    <td>
                                        <a href="?page=add-user&edit=<?php echo $rowUser['id']; ?>"
                                            class="btn btn-success">Edit</a>
                                        <a onclick="return alert('Are you sure?')"
                                            href="?page=user&delete=<?php echo $rowUser['id']; ?>"
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