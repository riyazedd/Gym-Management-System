<?php
include '../dbcon.php';

//Updating Equipment Information
if(isset($_GET['id'])) $id=$_GET['id'];//setting id of equipment

if(!empty($_POST)){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $date=$_POST['date'];
    $quantity=$_POST['quantity'];
    $vendor=$_POST['vendor'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $cost=$_POST['cost'];
    $total_cost=$quantity*$cost;

    // Check if the vendor already exists
    $vendorExistsQuery = "SELECT id FROM vendors WHERE vendor_name = '$vendor'";
    $vendorExistsResult = mysqli_query($conn, $vendorExistsQuery);

    if(mysqli_num_rows($vendorExistsResult) > 0) {
        // If the vendor exists, get its ID
        $vendorData = mysqli_fetch_assoc($vendorExistsResult);
        $vendorId = $vendorData['id'];
    } else {
        // If the vendor doesn't exist, insert it and get its ID
        $insertVendorQuery = "INSERT INTO vendors (vendor_name, address, contact) VALUES ('$vendor', '$address', '$contact')";
        mysqli_query($conn, $insertVendorQuery);
        $vendorId = mysqli_insert_id($conn);
    }

    $sql="UPDATE equipment SET name='$name',description='$description',date='$date',quantity='$quantity',vendor_id='$vendorId',
    amount='$cost',total_amount='$total_cost'WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['success']="Infromation Updated";
        header("Location:equipment-list.php");
    }
}
//Displaying Existing Information
$sql="SELECT equipment.*, vendors.vendor_name, vendors.address, vendors.contact
    FROM equipment
    LEFT JOIN vendors ON equipment.vendor_id=vendors.id
    WHERE equipment.id=$id";
$res=mysqli_query($conn,$sql);
while($user=mysqli_fetch_assoc($res)){
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitManage Hub - Admin</title>
        <link rel="stylesheet" href="css/equipment-update.css">
    <script src="https://kit.fontawesome.com/426c1a4028.js" crossorigin="anonymous"></script>   
</head>
<body>
    <?php include 'includes/template.php';?>

<div class="content">
    <h2>Update Equipment Information</h2><h3>
    <div class="form-container">
        <form action="" method="post">
            <div class="left">
                <h3>Equipment-Info</h3>
                <label for="name">Equipment Name</label>
                <input type="text" name="name" value="<?=$user['name']?>"><br>
                <label for="description">Description</label>
                <input type="text" name="description" value="<?=$user['description']?>"><br>
                <label for="date">Date of Purchase</label>
                <input type="date" name="date" value="<?=$user['date']?>"><br>
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="<?=$user['quantity']?>"><br>
            </div>
            <div class="right">
                <div class="vendor-detail">
                    <h3>Vendor Details</h3>
                    <label for="vendor">Vendor</label>
                    <input type="text" name="vendor" value="<?=$user['vendor_name']?>"><br>
                    <label for="address">Address</label>
                    <input type="text" name="address" value="<?=$user['address']?>"><br>
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" value="<?=$user['contact']?>"><br>
                </div>
                <div class="pricing">
                    <h3>Pricing Details</h3>
                    <label for="cost">Cost Per Item</label>
                    <input type="number" name="cost" value="<?=$user['amount']?>"><br>
                </div>
                <button>Update Information</button>
            </div>
        </form>
    </div>
</div>

<?php } include 'includes/footer.php';?>