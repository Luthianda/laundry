<?php
if (strtolower($rowLevel['level_name']) == 'leader') {
    header("location:home.php?access=denied");
    exit;
}

if (isset($_GET['edit'])) {
    $id_customer = $_GET['edit'];
    $title = "Edit";
    $query = mysqli_query($config, "SELECT * FROM customers WHERE id = '$id_customer'");
    if (mysqli_num_rows($query) == 0) {
        header("location:?page=customer&data=notfound");
        exit();
    }
    $row = mysqli_fetch_assoc($query);
    $name_form = $row['customer_name'];
    $phone_form = $row['phone'];
    $address_form = $row['address'];

    if (isset($_POST['customer_name'])) {
        $id_level = $_POST['id_level'];
        $name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        mysqli_query($config, "UPDATE customers SET customer_name = '$name', phone = '$phone', address = '$address' WHERE id = '$id_customer'");
        header("location:?page=customer&change=success");
    }
} else {
    $title = "Add";
    $name_form = "";
    $phone_form = "";
    $address_form = "";

    if (isset($_POST['customer_name'])) {
        $id_level = $_POST['id_level'];
        $name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        mysqli_query($config, "INSERT INTO customers (customer_name, phone, address) VALUES ('$name', '$phone', '$address')");
        header("location:?page=customer&add=success");
    }

}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?> Customer</h5>
                <div class="mb-3" align="right">
                    <a href="?page=customer" class="btn btn-secondary">Back</a>
                </div>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" id="name" class="form-control"
                            placeholder="Enter your name" value="<?php echo $name_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone"
                            value="<?php echo $phone_form; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" cols="30" rows="10"
                            class="form-control"><?php echo $address_form; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>