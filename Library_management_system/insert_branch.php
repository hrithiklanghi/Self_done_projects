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
<label>Branch Id </label>
<input type="text" name="branchno" value="" placeholder="Enter branch id" /><br>
<label>Branch name </label>
<input type="text" name="brname" value="" placeholder="Enter branch name" /><br>
<label>Manager Id </label>
<input type="text" name="manid" value="" placeholder="Enter Manager id" /><br>

<input type="submit" name="submit" value="submit">
</form>


<?php
$brno = $_GET['branchno'];
$manid = $_GET['manid'];
$brname = $_GET['brname'];

$query = "INSERT INTO branch VALUES('$brno','$brname','$manid')";
$newq = "UPDATE employee SET position='Manager' WHERE em_id=$manid";
$newqu = "UPDATE branch SET branch_name='$brname', manager_id='$manid' WHERE branch_id=$brno";

$data = mysqli_query($conn, $query);

$newd = mysqli_query($conn, $newq);

if(!$data){
	$newda = mysqli_query($conn, $newqu);
}
if($data || $newda){
	echo "Data inserted successfully";
}
if(!$newda && !$data)
{
	echo "Error while inserting data";
}
?>

</body>
</html>

