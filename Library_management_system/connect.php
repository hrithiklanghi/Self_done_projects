<?php
$servername = "localhost";
$username = "hrithiklanghi";
$password = "Hrithik@13";
$dbname = "library";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn){
	
	}
	
else{
	die("connection failed ".mysqli_connect_error());
	}
	
?>
