<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
	{
$delid=intval($_GET['del']);
$sql = "delete from vehicles SET id=:status WHERE  id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
$msg="Vehicle  record deleted successfully";
}


$sql = "SELECT * FROM vehicles";
$query = $dbh->prepare($sql);
$query->execute();
$vehicle = $query->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Car Rental Portal |Admin Manage Vehicles </title>

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

                        <h2 class="page-title">Manage Vehicles</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Vehicle Details</div>
                            <div class="panel-body">
                                <?php if($error){?><div class="errorWrap">
                                    <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle Make</th>
                                            <th>Model </th>
                                            <th>Model Year</th>
                                            <th>Fuel Type</th>
                                            <th>Color</th>
                                            <th>Registration No.</th>
                                            <th>Available</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($vehicle as $key => $vehicle): ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $vehicle['VehiclesMake']; ?></td>
                                            <td><?php echo $vehicle['VehiclesModel']; ?></td>
                                            <td><?php echo $vehicle['ModelYear']; ?></td>
                                            <td><?php echo $vehicle['FuelType']; ?></td>
                                            <td><?php echo $vehicle['Color']; ?></td>
                                            <td><?php echo $vehicle['RegNo']; ?></td>
                                            <td><?php echo $vehicle['available']; ?></td>

                                            <td>
                                                <a href="edit-vehicle.php?username=<?php echo $vehicle['RegNo']; ?>"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <a href="manage-vehicles.php?del=<?php echo $employee['RegNo']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this employee?');"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>



                            </div>
                        </div>



                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="add-vehicle.php" class="btn btn-primary">Add Car</a>
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
<?php } ?>