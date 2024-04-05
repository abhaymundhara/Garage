<html>

<head>
    <title> Customer Signup | Car Rentals </title>
</head>
<?php session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

<link rel="stylesheet" href="assets/w3css/w3.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    Car Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_employee'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
                            <?php echo $_SESSION['login_employee']; ?></a>
                    </li>
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><span
                                        class="glyphicon glyphicon-user"></span> Control Panel <span
                                        class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="entercar.php">Add Car</a></li>
                                    <li> <a href="entercustomer.php"> Add Customer</a></li>
                                    <li> <a href="employeeview.php">Data Entry</a></li>
                                    <li> <a href="prereturncar.php">Return Now</a></li>
                                    <li> <a href="mybookings.php"> My Bookings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
                }

                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="employeelogin.php">Employee</a>
                    </li>
                    <li>
                        <a href="admin/index.php">Admin Panel</a>
                    </li>

                </ul>
            </div>
            <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php

require 'connection.php';
$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case 'assets/img/cars/bmp': return '.bmp';
        case 'assets/img/cars/gif': return '.gif';
        case 'assets/img/cars/jpeg': return '.jpg';
        case 'assets/img/cars/png': return '.png';
        default: return false;
    }
}

$car_id = $conn->real_escape_string($_POST['hidden_carid']);
$sql0 = "SELECT c.car_name, c.car_nameplate FROM cars c WHERE c.car_id = $car_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $car_nameplate = $row0["car_nameplate"];
    }
}


$fine_amount = $conn->real_escape_string($_POST['fine_amount']);
$fine_desc = $conn->real_escape_string($_POST['fine_description']);
$fine_date = date('Y-m-d', strtotime($_POST['fine_date']));
$toll_amount = $conn->real_escape_string($_POST['toll_charge']);
$toll_desc = $conn->real_escape_string($_POST['toll_description']);
$toll_date = date('Y-m-d', strtotime($_POST['toll_date']));
$car_availability = "yes";
$success = "";


// $query = "INSERT into cars(car_name,car_nameplate,ac_price,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $car_availability ."')";
// $success = $conn->query($query);


if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename=$_FILES["uploadedimage"]["name"];
    $target_path = "assets/img/cars/".$imagename;

    if(move_uploaded_file($temp_name, $target_path)) {
        //$query0="INSERT into cars (car_img) VALUES ('".$target_path."')";
      //  $query0 = "UPDATE cars SET car_img = '$target_path' WHERE ";
        //$success0 = $conn->query($query0);

        $query = "INSERT into fines_and_tolls(car_id,car_name,car_nameplate,fine_amount,fine_date,fine_description,toll_charge,toll_date,toll_description,car_img) VALUES('" . $car_id . "','" . $car_name . "','" . $car_nameplate . "','" . $fine_amount . "','" . $fine_date . "','" . $fine_desc . "','" . $toll_amount . "','" . $toll_date . "','" . $toll_desc . "','". $target_path ."')";
        
        $success = $conn->query($query);

        
    } 

}
else
$query = "INSERT into fines_and_tolls(car_id,car_nameplate,fine_amount,fine_date,fine_description,toll_charge,toll_date,toll_description) VALUES('" . $car_id . "','" . $car_nameplate . "','" . $fine_amount . "','" . $fine_date . "','" . $fine_desc . "','" . $toll_amount . "','" . $toll_date . "','" . $toll_desc . "')";
        
$success = $conn->query($query);


if (!$success){ ?>

    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            Car with the same vehicle number already exists!
            <?php 
            echo $conn->error; 
            echo $fine_amount;
            echo $fine_date;
            ?>
            <br><br>
            <a href="fine&toll.php" class="btn btn-default"> Go Back </a>
        </div>
        <?php	
}
else {
    ?>
    <div class = container>
    <div class="jumbotron" style="text-align: center;">
            Car added successfully!
            <br><br>
            <a href="fine&toll.php" class="btn btn-default"> Go Back </a>
        </div></div>
    <?php
    //header("location: entercar.php"); //Redirecting 
}

$conn->close();

?>

</body>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> Car Rentals</h5>
            </div>
        </div>
    </div>
</footer>

</html>