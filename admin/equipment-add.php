<?php
include '../dbcon.php';

//Inserting/Adding Equipment
if(!empty($_POST)){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $vendor = $_POST['vendor'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $cost = $_POST['cost'];
    $total_cost = $quantity * $cost;

    // Check if the vendor already exists
    $vendorExistsQuery = "SELECT id FROM vendors WHERE name = '$vendor'";
    $vendorExistsResult = mysqli_query($conn, $vendorExistsQuery);

    if(mysqli_num_rows($vendorExistsResult) > 0) {
        // If the vendor exists, get its ID
        $vendorData = mysqli_fetch_assoc($vendorExistsResult);
        $vendorId = $vendorData['id'];
    } else {
        // If the vendor doesn't exist, insert it and get its ID
        $insertVendorQuery = "INSERT INTO vendors (name, address, contact) VALUES ('$vendor', '$address', '$contact')";
        mysqli_query($conn, $insertVendorQuery);
        $vendorId = mysqli_insert_id($conn);
    }

    // Insert equipment with vendor ID
    $sql = "INSERT INTO equipment (name, description, date, quantity, vendor_id, amount, total_amount) 
            VALUES ('$name', '$description', '$date', '$quantity', '$vendorId', '$cost', '$total_cost')";
    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['success'] = "New Equipment Added";
    }
}
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/equipment-add.css">
        <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
    </head>
    <body>
    <?php include 'includes/template.php';?>

<div class="content">
    <h2>Add New Equipments</h2><h3>
    <?php if(isset($_SESSION['success'])){ ?> <div class="message"><h3><?=$_SESSION['success'];  unset($_SESSION['success'])?></h3></div><?php } ?>
    <div class="form-container">
        <form action="" method="post">
            <div class="left">
                <h3>Equipment-Info</h3>
                <label for="name">Equipment Name</label>
                <input type="text" name="name"><br>
                <label for="description">Description</label>
                <input type="text" name="description"><br>
                <label for="date">Date of Purchase</label>
                <input type="date" name="date"><br>
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity"><br>
            </div>
            <div class="right">
                <div class="vendor-detail">
                    <h3>Vendor Details</h3>
                    <label for="vendor">Vendor</label>
                    <input type="text" name="vendor"><br>
                    <label for="address">Address</label>
                    <input type="text" name="address"><br>
                    <label for="contact">Contact</label>
                    <input type="text" name="contact"><br>
                </div>
                <div class="pricing">
                    <h3>Pricing Details</h3>
                    <label for="cost">Cost Per Item</label>
                    <input type="number" name="cost"><br>
                </div>
                <button>Add Equipment</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php';?>