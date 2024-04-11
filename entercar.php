<!DOCTYPE html>
<html>

<?php 
include('session_employee.php'); ?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

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
                                    <li> <a href="fine&toll.php">Data Entry</a></li>
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

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Please Provide Your Car
                        Details. </h3>

                    <!-- <div class="form-group"> -->
                    <label>
                        <h5>Car Name:</h5>
                    </label>
                    <input type="text" id="car_name" name="car_name" required autofocus="">
                    &nbsp;
                    <!-- </div> -->

                    <div class="form-group">
                        <label>
                            <h5>Car NumberPlate:</h5>
                        </label>
                        <input type="text" id="car_nameplate" name="car_nameplate" required>
                    </div>

                    <div class="form-group">
                        <label>
                            <h5>Vehicle Identification Number :</h5>
                        </label>
                        <input type="text" id="car_regno" name="car_regno" required>
                    </div>

                    
                    <label>
                    <h5>Registered in the Name:
                </label>
                    <select name="employee_id_from_dropdown" ng-model="myVar1">
                        <?php
                        $sql2 = "SELECT employee_name FROM employees";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $employee_id = $row2["employee_id"];
                                $employee_name = $row2["employee_name"];
                    ?>


                        <option value="<?php echo($employee_name); ?>"><?php echo($employee_name); ?>


                            <?php }}
                          ?>
                    </select></h5>
                    <div class="form-group">
                        <label>
                            <h5>Car Model Year:</h5>
                        </label>
                        <input type="text" id="model_year" name="model_year" required>
                    </div>

                    <div class="form-group">
                        <label>
                            <h5>Car Color:</h5>
                        </label>
                        <input type="text" id="car_color" name="car_color" required>
                    </div>

                    <!-- <div class="form-group"> -->
                    <?php $today = date("d-m-Y") ?>
                    <label>
                        <h5>RC Expiry Date:</h5>
                    </label>
                    <input type="date" name="rc_expiry" min="<?php echo($today);?>" required="">
                    &nbsp;
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    
                    <label>
                        <h5>Insurance Expiry Date:</h5>
                    </label>
                    <input type="date" name="insurance_expiry" min="<?php echo($today);?>" required="">
                    &nbsp;
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    
                    <label>
                        <h5>Last Serviced:</h5>
                    </label>
                    <input type="date" name="last_service" min="<?php echo($today);?>" required="">
                    &nbsp;
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    
                    <label>
                        <h5>Next Service:</h5>
                    </label>
                    <input type="date" name="next_service" min="<?php echo($today);?>" required="">
                    &nbsp;
                    <!-- </div> -->

                    <div class="form-group">
                        <input name="uploadedimage" type="file">
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Submit
                        for Rental</button>
                </form>
            </div>
        </div>


        <div class="col-md-12" style="float: none; margin: 0 auto;">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Cars </h3>
                    <?php
// Storing Session
$user_check=$_SESSION['login_employee'];
$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  ?>
                    <div style="overflow-x:auto;">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th width="24%"> Name</th>
                                    <th width="15%"> Nameplate </th>
                                    <th width="15%"> Registration Number </th>
                                    <th width="15%"> Registered Name </th>
                                    <th width="15%"> Model Year </th>
                                    <th width="15%"> Car Color </th>
                                    <th width="15%"> RC Expiry </th>
                                    <th width="15%"> Insurance Expiry </th>
                                    <th width="15%"> Last Serviced: </th>
                                    <th width="15%"> Next Service: </th>
                                    <th width="1%"> Availability </th>
                                </tr>
                            </thead>

                            <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
    ?>

                            <tbody>
                                <tr>
                                    <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
                                    <td><?php echo $row["car_name"]; ?></td>
                                    <td><?php echo $row["car_nameplate"]; ?></td>
                                    <td><?php echo $row["car_regno"]; ?></td>
                                    <td><?php echo $row["car_regname"]; ?></td>
                                    <td><?php echo $row["model_year"]; ?></td>
                                    <td><?php echo $row["car_color"]; ?></td>
                                    <td><?php echo $row["rc_expiry"]; ?></td>
                                    <td><?php echo $row["insurance_expiry"]; ?></td>
                                    <td><?php echo $row["last_service"]; ?></td>
                                    <td><?php echo $row["next_service"]; ?></td>
                                    <td><?php echo $row["car_availability"]; ?></td>

                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <br>
                    <?php } else { ?>
                    <h4>
                        <center>0 Cars available</center>
                    </h4>
                    <?php } ?>
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