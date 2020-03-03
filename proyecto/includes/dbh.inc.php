<?php 


$servername = "localhost";
$dbUsername = "root"; 
$dbPassword = "";
$dbName = "loginsystemtut";


$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);


if (!$conn) {
	die("Conecction failed: " . mysql_connect_error());
}