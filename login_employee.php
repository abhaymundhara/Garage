<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['employee_username']) || empty($_POST['employee_password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$client_username=$_POST['employee_username'];
$client_password=$_POST['employee_password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT employee_username, employee_password FROM employees WHERE employee_username=? AND employee_password=? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $client_username, $client_password);
$stmt -> execute();
$stmt -> bind_result($client_username, $client_password);
$stmt -> store_result();

if ($stmt->fetch())  //fetching the contents of the row
{
	$_SESSION['login_employee']=$client_username; // Initializing Session
	header("location: index.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>