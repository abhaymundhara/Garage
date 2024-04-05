<!DOCTYPE html>
<html>
<?php 
include('session_employee.php'); ?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
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

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="entercustomer1.php" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Enter Customer Details </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="customer_username" name="customer_username"
                            placeholder="Customer Name " required autofocus="">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="dl_number" name="dl_number"
                            placeholder="Driving License Number" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                            placeholder="Contact" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="customer_address" name="customer_address"
                            placeholder="Address" required>
                    </div>

                    <div class="form-group">
                        <select name="customer_city" class="form-control" id="customer_city" placeholder="City"
                            required>

                            <option value=""> City </option>
                            <option value="Abu Dhabi">Abu Dhabi</option>
                            <option value="Dubai">Dubai</option>
                            <option value="Sharjah">Sharjah</option>
                            <option value="Ajman">Ajman</option>
                            <option value="Umm Al Quwain">Umm Al Quwain</option>
                            <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                            <option value="Fujairah">Fujairah</option>
                            
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" id="customer_email" name="customer_email"
                            placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="ref_by" name="ref_by" placeholder="Reference"
                            required>
                    </div>

                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> Add
                        Customer</button>
                </form>
            </div>
        </div>
        <div class="col-md-9" style="float: none; margin: 0 auto;">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Customers </h3>
                    <?php


// Storing Session
$user_check=$_SESSION['login_employee'];
$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  ?>

                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th> </th>
                                <th> Name</th>
                                <th> City </th>
                                <th> License No. </th>
                                <th> Contact </th>
                                <th> Address </th>

                            </tr>
                        </thead>

                        <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
    ?>

                        <tbody>
                            <tr>
                                <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
                                <td><?php echo $row["customer_username"]; ?></td>
                                <td><?php echo $row["customer_city"]; ?></td>
                                <td><?php echo $row["dl_number"]; ?></td>
                                <td><?php echo $row["customer_phone"]; ?></td>
                                <td><?php echo $row["customer_address"]; ?></td>


                            </tr>
                        </tbody>

                        <?php } ?>
                    </table>
                    <br>


                    <?php } else { ?>

                    <h4>
                        <center>0 customers available</center>
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