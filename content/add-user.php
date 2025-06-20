<?php
$queryLevel = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
$rowLevels = mysqli_fetch_all($queryLevel, MYSQLI_ASSOC);

if (isset($_GET['edit'])) {
    $id_user = $_GET['edit'];
    $title = "Edit";
    $queryUser = mysqli_query($config, "SELECT * FROM users WHERE id = '$id_user'");
    $rowUser = mysqli_fetch_assoc($queryUser);
    $name_form = $rowUser['name'];
    $email_form = $rowUser['email'];
    $required = "";

    if (isset($_POST['name'])) {
        $id_level = $_POST['id_level'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = empty($_POST['password']) ? $row['password'] : sha1($_POST['password']);
        mysqli_query($config, "UPDATE user SET id_level = '$id_level', name = '$name', email = '$email', password = '$password' WHERE id = '$id_user'");
        header("location:?page=user&change=success");
    }
} else {
    // variabel dibawah untuk alternatif value input yang panjang. contoh: value="<?= isset($rowEdit['name'])? $rowEdit['name'] : '' (tingal ditutup yg bener)
    $name_form = "";
    $email_form = "";
    $required = "required";

    if (isset($_POST['name'])) {
        $id_level = $_POST['id_level'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        mysqli_query($config, "INSERT INTO users (id_level, name, email, password) VALUES ('$id_level', '$name', '$email', '$password')");
        header("location:?page=user&add=success");
    }

}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                        <select name="id_level" id="level" class="form-control" required>
                            <option value="">Choose your level</option>
                            <?php foreach ($rowLevels as $key => $data) { ?>
                                <option <?php echo isset($_GET['edit']) ? ($row['id_level'] == $data['id'] ? 'selected' : '') : '' ?> value="<?php echo $data['id'] ?>"><?php echo $data['level_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name"
                            value="<?php echo $name_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                            value="<?php echo $email_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password
                            <?php echo isset($_GET['edit']) ? '' : '<span class="text-danger">*</span>' ?></label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" <?php echo $required; ?>>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="save" value="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>