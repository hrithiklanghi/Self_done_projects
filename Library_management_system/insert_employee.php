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
<input type="text" name="id" value="" placeholder="Enter employee id" /><br>
<label>Employee name </label>
<input type="text" name="name" value="" placeholder="Enter Employee name" /><br>
<label>Position </label>
<input type="text" name="pos" value="" placeholder="Enter Position" /><br>

<input type="submit" name="submit" value="submit">
</form>

<?php

$id = $_GET['id'];
$name = $_GET['name'];
$pos = $_GET['pos'];


$query = "INSERT INTO employee VALUES('$id','$name','$pos')";
$newq = "UPDATE employee SET em_name='$name', position='$pos' WHERE em_id=$id";
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
