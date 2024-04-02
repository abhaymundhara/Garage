<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "u212206598_abhay";
	$dbpass = "Abhay@0811";
	$dbname = "u212206598_Garage";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

	return $conn;
}
?>