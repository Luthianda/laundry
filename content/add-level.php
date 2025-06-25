<?php
    if (isset($_GET['edit'])) {
        $id_level = $_GET['edit'];
        $title = "Edit";
        $queryLevel = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id_level'");
        $rowLevel = mysqli_fetch_assoc($queryLevel);
        $level_form = $rowLevel['level_name'];

        if (isset($_POST['level_name'])) {
            $level = $_POST['level_name'];
            mysqli_query($config, "UPDATE levels SET level_name = '$level' WHERE id = '$id_level'");
            header("location:?page=level&change=success");
        }
    } else {
        $level_form = "";
        
        if (isset($_POST['level_name'])) {
            $level = $_POST['level_name'];
            mysqli_query($config, "INSERT INTO levels (level_name) VALUES ('$level')");
            header("location:?page=level&add=success");
        }

    }
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Level</h5>
                <div class="mb-3" align="right">
                    <a href="?page=level" class="btn btn-secondary">Back</a>
                </div>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Level Name <span class="text-danger">*</span></label>
                        <input type="text" name="level_name" id="" class="form-control" placeholder="Enter your level name" value="<?php echo $level_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>