<?php
include("connect.php");
$id = $_GET['id'];
$query = "DELETE FROM books WHERE USBN='$id'";
$data = mysqli_query($conn, $query);

if($data){
	echo "Record deleted";
	}
else{
	echo "Cannot delete this record!!";
}
?>
