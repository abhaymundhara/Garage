<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>

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


    <script type="text/javascript">
        // Function to calculate date difference and update display
        function handleChange(event) {
            var inputValue = event.target.value; // Get return date value
            console.log ('handler called', inputValue)
            var rentStartDate = "<?php echo $rent_start_date; ?>"; // Get rental start date from PHP
            var diffInDays = dateDiff(rentStartDate, inputValue); // Calculate date difference
            document.getElementById("no_of_days").innerText = diffInDays; // Update no of days display

            var fare = "<?php echo $fare; ?>"; // Get fare from PHP
            var grossAmt = diffInDays * fare; // Calculate gross amount
            document.getElementById("amount").innerText = grossAmt; // Update amount display
        }

        // Function to calculate date difference
        function dateDiff(start, end) {
            var startTs = new Date(start).getTime();
            var endTs = new Date(end).getTime();
            var diff = endTs - startTs;
            return Math.round(diff / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
        }
        window.addEventListener('load', function() {
            console.log ('perfect')
            // Add event listener when the DOM content is loaded
            
            var inputField = document.getElementById("car_return_date");

            // Add event listener for the change event
            inputField.addEventListener("change", handleChange);
   
});
       
    </script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $id = $_GET["id"];
 $sql1 = "SELECT c.car_name, c.car_nameplate, rc.rent_start_date, rc.rent_end_date, rc.car_return_date, rc.fare, rc.fare1, rc.no_of_days, d.customer_username, d.customer_phone
 FROM rentedcars rc, cars c, customer d
 WHERE id = '$id' AND c.car_id=rc.car_id AND d.customer_id = rc.customer_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $car_name = $row["car_name"];
        $car_nameplate = $row["car_nameplate"];
        $customer_name = $row["customer_username"];
        $customer_phone = $row["customer_phone"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $fare1 = $row["fare1"];
       // $charge_type = $row["charge_type"];
        $no_of_days = dateDiff("$rent_start_date", "$car_return_date");
        //$extra_days = dateDiff("$rent_end_date", "$car_return_date");
    }
}
?>
    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Journey Details </h3>
                    <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Allow your customer to fill
                        the below form </h6>

                    <h5> Car:&nbsp; <?php echo($car_name);?></h5>

                    <h5> Vehicle Number:&nbsp; <?php echo($car_nameplate);?></h5>

                    <h5> Rent date:&nbsp; <?php echo($rent_start_date);?></h5>

                    <h5> End Date:&nbsp; <?php echo($rent_end_date);?></h5>

                    <h5> Fare:&nbsp; <?php echo($fare);?> Dirhams</h5>

                    <h5> Customer Name:&nbsp; <?php echo($customer_name);?></h5>

                    <h5> Customer Contact:&nbsp; <?php echo($customer_phone);?></h5>

                    <h5> Return Date:&nbsp; <input type="date" name="car_return_date"
                            min="<?php echo($rent_start_date);?>" required=""></h5>
                     
                    <?php $No_of_Day = ($car_return_date - $rent_start_date);
                    

                    
                          $Gross_Amt = ($No_of_Day * $fare) ?>
                    <h5> No of Days :&nbsp; <span id="no_of_days"></span></h5>
                    <h5> Amount :&nbsp; <?php echo($Gross_Amt);?></h5>
                <h5>Extra Fare: <b><input type="text" id="fare1" name="fare1"> Dirhams/day</b>
                <h5> Final Amount :&nbsp; <?php echo($Gross_Amt+ $fare1);?></h5>

                    
                    <input type="hidden" name="months_or_days" value="<?php echo $no_of_days; ?>">
                   
                    <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">

                    <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">
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