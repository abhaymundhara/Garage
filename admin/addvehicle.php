<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}

if(isset($_POST['submit']))
  {
$vehiclemake=$_POST['vehiclemake'];
$vehiclemodel=$_POST['vehiclemodel'];
$vehicleoverview=$_POST['vehicleoverview'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
$seatingcapacity=$_POST['seatingcapacity'];
$color=$_POST['color'];

$sql="INSERT INTO vehicles (VehiclesMake, VehiclesModel, VehiclesOverview, FuelType, ModelYear, SeatingCapacity, Color) VALUES (:vehiclemake, :vehiclemodel, :vehicleoverview,: fueltype, :modelyear, :seatingcapacity, :color)";
$query = $dbh->prepare($sql);
$query->bindParam(':vehiclemake',$vehiclemake,PDO::PARAM_STR);
$query->bindParam(':vehiclemodel',$vehiclemodel,PDO::PARAM_STR);
$query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
$query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
$query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
$query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
$query->bindParam(':color',$color,PDO::PARAM_STR);
if($query->execute()) {
	$_SESSION['msg'] = "Car added successfully";
} else {
	$_SESSION['error'] = "Failed to add Car";
}

header('Location: manage-vehicles.php');

}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Car Rental Portal | Admin Post Vehicle</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
    </style>

</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Post A Vehicle</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>


                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Vehicle Make<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="vehiclemake" class="form-control" required>
                                                </div>
                                                <label class="col-sm-2 control-label">Vehicle Model<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="vehiclemodel" class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Model Year<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="modelyear" class="form-control" required>
                                                </div>
                                                <label class="col-sm-2 control-label">Seating Capacity<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="seatingcapacity" class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fuel Type<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="fueltype" required>
                                                        <option value=""> Select </option>

                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Electric">Electric</option>
                                                    </select>
                                                </div>


                                                <label class="col-sm-2 control-label">Colour<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="color" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Vehical Overview<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="vehicleoverview" rows="2"
                                                        required></textarea>
                                                </div>
                                            </div>


                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn btn-default" type="reset">Cancel</button>
                                                    <button class="btn btn-primary" name="submit" type="submit">Save
                                                        changes</button>
                                                </div>
                                            </div>



                                    </div>
                                </div>
                            </div>





                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>



    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>

</html>