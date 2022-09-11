<style>
td
{
	padding:6px;
}
</style>
<?php
include("connect.php");
error_reporting(0);
$query = "SELECT * FROM customer";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total!=0)
{
	?>
	<table>
		<tr>
			<th>cust_id</th>
			<th>cust_name</th>
			<th>regis_date</th>
			<th colspan="2">Operations</th>
		</tr>
	<?php
	while($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
			<td>".$result[cust_id]."</td>
			<td>".$result[cust_name]."</td>
			<td>".$result[regis_date]."</td>
			<td><a href='/insert_customer.php'>Edit</a></td>
			<td><a href='/delete_customer.php?id=$result[cust_id]' onclick='return checkdelete()'>Delete</a></td>
		         </tr>";
	}
}
else 
{
	echo "No records found";
}

?>
</table>
<script>
function checkdelete()
{
	return confirm('Sure to delete record??');
}
</script>

