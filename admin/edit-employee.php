<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {  
    header('location:index.php');
}

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $sql = "UPDATE employees SET UserName = :name, Role = :role, Password = :password WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    

    if($query->execute()) {
        $_SESSION['msg'] = "Employee details updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update employee details";
    }

    header('Location: manage-employees.php');
    
}

$name = $_GET['username'];
echo "<script>console.log('this is a Variable: " . $name ."' );</script>";

$sql = "SELECT * FROM employees WHERE UserName = :u_name";
$query = $dbh->prepare($sql);
$query->bindParam(':u_name', $name, PDO::PARAM_STR);
$query->execute();
$employee = $query->fetch(PDO::FETCH_ASSOC);
echo "<script>console.log('this is a Variable: " . $employee["UserName"] ."' );</script>";
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
    
    <title>Edit Employees</title>

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
        <h2>Edit Employee</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $employee['UserName']; ?>" required>
            </div>
            <label class="col-sm-2 control-label">Role<span style="color:red">*</span></label>
<div class="form-group">
<select class="selectpicker" name="role">
<option value="<?php echo $employee['Role']; ?>"> <?php echo $employee['Role']; ?> </option>

<option value="admin">Admin</option>
<option value="viewer">Viewer</option>
</select>
</div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $employee['Password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

    <!-- Include any necessary JavaScript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
