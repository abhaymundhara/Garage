<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {  
    header('location:index.php');
}


if(isset($_POST['submit'])) {
    $make = $_POST['vehiclemake'];
    $model = $_POST['vehiclemodel'];
    $modelyear = $_POST['year']; 
    $seats = $_POST['seatcap'];

    $sql = "INSERT INTO vehicles (VehiclesMake, VehiclesModel, ModelYear, SeatingCapacity) VALUES (:vehiclemake, :vehiclemodel, :year, :seatcap)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehiclemake', $make, PDO::PARAM_STR);
    $query->bindParam(':vehiclemodel', $model, PDO::PARAM_STR);
    $query->bindParam(':year', $modelyear, PDO::PARAM_STR);
    $query->bindParam(':seatcap', $seats, PDO::PARAM_STR);

    if($query->execute()) {
        $_SESSION['msg'] = "Employee added successfully";
    } else {
        $_SESSION['error'] = "Failed to add employee";
    }
    header('Location: manage-vehicles.php');
    
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Manage Cars</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="container">
        <h2>Add Car</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="vehiclemake">Make:</label>
                <input type="text" class="form-control" id="vehiclemake" name="vehiclemake" required>
            </div>
            
            <div class="form-group">
                <label for="vehiclemodel">Model:</label>
                <input type="text" class="form-control" id="vehiclemodel" name="vehiclemodel" required>
            </div>

            <div class="form-group">
                <label for="year">Model Year:</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>

            <div class="form-group">
                <label for="seatcap">Seats:</label>
                <input type="text" class="form-control" id="seatcap" name="seatcap" required>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

    <!-- Include any necessary JavaScript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>