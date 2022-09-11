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
<label>Issue Id </label>
<input type="text" name="id" value="" placeholder="Enter issue id of book" /><br>
<label>Customer </label>
<input type="text" name="cus" value="" placeholder="Enter customer of book" /><br>
<label>Book name </label>
<input type="text" name="Title" value="" placeholder="Enter Title of book" /><br>
<label> Date(yyyy-mm-dd)</label>
<input type="text" name="Date" value="" placeholder="Enter Date of issue" /><br>
<label>Bookid</label>
<input type="text" name="bookid" value="" placeholder="Enter Book_id" /><br>

<input type="submit" name="submit" value="submit">
</form>

<?php>

$id = $_GET['id'];
$cus = $_GET['cus'];
$title = $_GET['Title'];
$date = $_GET['Date'];
$bookid = $_GET['bookid'];

$newq = "UPDATE books SET status='Unavailable' WHERE USBN=$bookid";
$query = "INSERT INTO issued VALUES('$id','$cus','$title','$date','$bookid')";
$newqu = "UPDATE issued SET issued_cust_id='$cus', issued_book_title='$title', issue_date='$date', issued_book_id='$bookid' WHERE issue_id=$id";

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
