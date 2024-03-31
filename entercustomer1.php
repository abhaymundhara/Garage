<html>

<head>
    <title> Customer Signup | Car Rentals </title>
</head>
<?php session_start(); ?>
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
                                    <li> <a href="entercustomer.php"> Add customer</a></li>
                                    <li> <a href="employeeview.php">View</a></li>
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

$customer_name = $conn->real_escape_string($_POST['customer_username']);
$dl_number = $conn->real_escape_string($_POST['dl_number']);
$customer_phone = $conn->real_escape_string($_POST['customer_phone']);
$customer_address = $conn->real_escape_string($_POST['customer_address']);
$customer_city = $conn->real_escape_string($_POST['customer_city']);
$customer_email = $conn->real_escape_string($_POST['customer_email']);
$ref_by = $conn->real_escape_string($_POST['ref_by']);
$employee_username = $_SESSION['login_employee'];

$query = "INSERT into customer(customer_username,dl_number,customer_phone,customer_address,customer_city,customer_email,customer_refby,employee_username) VALUES('" . $customer_name . "','" . $dl_number . "','" . $customer_phone . "','" . $customer_address . "','" . $customer_city ."','" . $customer_email ."','" . $ref_by ."','" . $employee_username ."')";
$success = $conn->query($query);

if (!$success){ ?>
    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            Failed to add!
            <?php echo $conn->error; ?>
            <br><br>
            <a href="entercustomer.php" class="btn btn-default"> Go Back </a>
        </div>
        <?php	
}
else {
    ?>
    <div class = container>
    <div class="jumbotron" style="text-align: center;">
            Customer added successfully!
            <br><br>
            <a href="entercustomer.php" class="btn btn-default"> Go Back </a>
        </div></div>
        <?php
    
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