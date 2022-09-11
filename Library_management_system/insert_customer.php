<?php
include("connect.php");
error_reporting(0);
?>

<html>
<head>
Library management system
</head>

<body>
<form action="" method="GET">
<label>ID </label>
<input type="text" name="cusid" value="" placeholder="Enter customer id" /><br>
<label>Customer name </label>
<input type="text" name="name" value="" placeholder="Enter customer name" /><br>
<label>Registration date (yyyy-mm-dd)</label>
<input type="text" name="regdt" value="" placeholder="Enter Date of registration" /><br>

<input type="submit" name="submit" value="submit">
</form>

<?php

$id = $_GET['cusid'];
$cname = $_GET['name'];
$regdt = $_GET['regdt'];


$query = "INSERT INTO customer VALUES('$id','$cname','$regdt')";
$newq = "UPDATE customer SET cust_name='$cname', regis_date='$regdt' WHERE cust_id=$id";
$data = mysqli_query($conn, $query);

if(!$data){
	$newd = mysqli_query($conn, $newq);
}
if($data || $newd){
	echo "Data inserted successfully";
}
if(!$newd && !$data)
{
	echo "Error while inserting Data";
}

?>

</body>
</html>

