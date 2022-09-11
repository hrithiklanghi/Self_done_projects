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
Search using:<br>
<label>Return Id </label>
<input type="text" name="id" value="" placeholder="Enter return id" /><br>
<label>Customer Id</label>
<input type="text" name="cus" value="" placeholder="Enter customer of book" /><br>
<label>Book name </label>
<input type="text" name="Title" value="" placeholder="Enter Title of book" /><br>
<label> Date(yyyy-mm-dd)</label>
<input type="text" name="Date" value="" placeholder="Enter Date of issue" /><br>
<label>Book Id</label>
<input type="text" name="bookid" value="" placeholder="Enter Book_id" /><br>

<input type="submit" name="submit" value="submit">
</form>


<?php

$id = $_GET['id'];
$cus = $_GET['cus'];
$title = $_GET['Title'];
$date = $_GET['Date'];
$bookid = $_GET['bookid'];

$query = "INSERT INTO returned VALUES('$id','$cus','$title','$date','$bookid')";
$newq = "UPDATE books SET status='Available' WHERE USBN=$bookid";
$newqu = "UPDATE returned SET return_cust_id='$cus', returned_book_title='$title', return_date='$date', return_book_id='$bookid' WHERE return_id=$id";
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
	echo "Error while inserting Data";
}
?>

</body>
</html>
