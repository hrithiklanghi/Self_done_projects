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
<label>USBN </label>
<input type="text" name="USBN" value="" placeholder="Enter USBN of book" /><br>
<label>Title </label>
<input type="text" name="Title" value="" placeholder="Enter Title of book" /><br>
<label>Branch Id </label>
<input type="text" name="Branch" value="" placeholder="Enter BranchID of branch of book" /><br>
<label>Status </label>
<input type="text" name="Status" value="" placeholder="Enter Status of book" /><br>
<label>Author's name</label>
<input type="text" name="Author" value="" placeholder="Enter name of author" /><br>

<input type="submit" name="submit" value="submit">
</form>

<?php
$usbn = $_GET['USBN'];
$title = $_GET['Title'];
$genre = $_GET['Branch'];
$status = $_GET['Status'];
$aname = $_GET['Author'];

$query = "INSERT INTO books VALUES('$usbn','$title','$genre','$status','$aname')";
$newq = "UPDATE books SET book_title='$title', branch_id='$genre', status='$status', author='$aname' WHERE USBN=$usbn";

$data = mysqli_query($conn, $query);

if(!$data)
{
	$newd = mysqli_query($conn, $newq);
}

if($data || $newd){
	echo "Data inserted successfully";
}

if(!$newd && !$data)
{
	echo "Error while inserting data";
}

?>


</body>
</html>

