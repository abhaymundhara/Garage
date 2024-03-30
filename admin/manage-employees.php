<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {  
    header('location:index.php');
}

// Delete Employee
if(isset($_GET['del'])) {
    $id = $_GET['del'];

    $sql = "DELETE FROM employees WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if($query->execute()) {
        $_SESSION['msg'] = "Employee deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete employee";
    }

    header('Location: manage-employees.php');
    
}

// Fetch all employees
$sql = "SELECT * FROM employees";
$query = $dbh->prepare($sql);
$query->execute();
$employees = $query->fetchAll(PDO::FETCH_ASSOC);
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
    
    <title>Manage Employees</title>

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

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Manage Employees</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Employee List</div>
                            <div class="panel-body">
                                <?php if(isset($_SESSION['msg'])): ?>
                                    <div class="alert alert-success"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
                                <?php elseif(isset($_SESSION['error'])): ?>
                                    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                                <?php endif; ?>
                                
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($employees as $key => $employee): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $employee['id']; ?></td>
                                                <td><?php echo $employee['UserName']; ?></td>
                                                <td><?php echo $employee['Role']; ?></td>
                                                <td>
                                                    <a href="edit-employee.php?username=<?php echo $employee['UserName']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="manage-employees.php?del=<?php echo $employee['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');" class="btn btn-danger btn-sm">Delete</a>
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
                        <a href="add-employee.php" class="btn btn-primary">Add Employee</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
