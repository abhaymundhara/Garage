<!DOCTYPE html>
<html>
<?php 
 include('session_employee.php');
if(!isset($_SESSION['login_employee'])){
    session_destroy();
    header("location: employeelogin.php");
}
?>
<title>Update Car </title>

<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body ng-app="">


    <!-- Navigation -->
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
                        <a href="admin/index.php"> Admin Panel </a>
                    </li>
                </ul>
            </div>
            <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="process_fine&toll.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $car_name = $row1["car_name"];
                $car_nameplate = $row1["car_nameplate"];
                
            }
        }

        ?>

                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> UPDATE Car
                        Details. </h3>

                    <label>
                        <h5>Selected Car: <b><?php echo($car_name);?></b></h5>
                    </label>
                    &nbsp;



                    <label>
                        <h5>Car NumberPlate: <b><?php echo($car_nameplate);?></b></h5>
                    </label>

                    <label for="fine_amount">
                        <h5>Fine Amount:
                    </label>
                    <input type="number" id="fine_amount" name="fine_amount"><br><br>

                    <label>
                        <h5>Fine Date:</h5>
                    </label>
                    <input type="date" id="fine_date" name="fine_date"><br><br>


                    <label for="fine_description">Fine Description:</label>
                    <textarea id="fine_description" name="fine_description" rows="3" cols="50"
                        required></textarea><br><br>

                    <label for="toll_charge">Toll Charge:</label>
                    <input type="number" id="toll_charge" name="toll_charge"><br><br>

                    <label>
                        <h5>Toll Date:</h5>
                    </label>
                    <input type="date" id="toll_date" name="toll_date"><br><br>


                    <label for="toll_description">Toll Description:</label>
                    <textarea id="toll_description" name="toll_description" rows="3" cols="50"
                        required></textarea><br><br>


                    </h5>

                    <div class="form-group">
                        <label>
                            <h5>Upload picture(if any):</h5> &nbsp;
                                <input name="uploadedimage" type="file">
                        </label>
                    </div>
                    <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Submit
                        for Rental</button>
                </form>
            </div>
        </div>
    </div>

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