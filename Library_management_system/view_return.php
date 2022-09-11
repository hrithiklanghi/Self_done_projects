<style>
td
{
	padding:6px;
}
</style>
<?php
include("connect.php");
error_reporting(0);
$query = "SELECT * FROM returned";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total!=0)
{
	?>
	<table>
		<tr>
			<th>return_id</th>
			<th>Customer Id</th>
			<th>Book Title</th>
			<th>Date</th>
			<th>USBN</th>
			<th colspan="1">Operations</th>
		</tr>
	<?php
	while($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
			<td>".$result[return_id]."</td>
			<td>".$result[return_cust_id]."</td>
			<td>".$result[returned_book_title]."</td>
			<td>".$result[return_date]."</td>
			<td>".$result[return_book_id]."</td>
			<td><a href='/insert_return.php'>Edit</a></td>
		         </tr>";
	}
}
else 
{
	echo "No records found";
}

?>
</table>
