<?php
    if (isset($_GET['edit'])) {
        $id_services = $_GET['edit'];
        $title = "Edit";
        $query = mysqli_query($config, "SELECT * FROM type_of_services WHERE id = '$id_services'");
        $row = mysqli_fetch_assoc($query);
        $name_form = $row['service_name'];
        $price_form = $row['price'];
        $description_form = $row['description'];

        if (isset($_POST['service_name'])) {
            $id_level = $_POST['id_level'];
            $name = $_POST['service_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            mysqli_query($config, "UPDATE type_of_services SET service_name = '$name', price = '$price', description = '$description' WHERE id = '$id_services'");
            header("location:?page=services&change=success");
        }
    } else {
        $title = "Add";
        $name_form = "";
        $price_form = "";
        $description_form = "";
        
        if (isset($_POST['service_name'])) {
            $id_level = $_POST['id_level'];
            $name = $_POST['service_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            mysqli_query($config, "INSERT INTO type_of_services (service_name, price, description) VALUES ('$name', '$price', '$description')");
            header("location:?page=services&add=success");
        }

    }
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?> Type of Service</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="service_name" id="name" class="form-control" placeholder="Enter your type of service" value="<?php echo $name_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter your price" value="<?php echo $price_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $description_form; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>