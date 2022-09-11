<style>
td
{
	padding:6px;
}
</style>
<?php
include("connect.php");
error_reporting(0);
$query = "SELECT * FROM employee";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total!=0)
{
	?>
	<table>
		<tr>
			<th>em_id</th>
			<th>em_name</th>
			<th>position</th>
			<th colspan="2">Operations</th>
		</tr>
	<?php
	while($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
			<td>".$result[em_id]."</td>
			<td>".$result[em_name]."</td>
			<td>".$result[position]."</td>
			<td><a href='/insert_employee.php'>Edit</a></td>
			<td><a href='/delete_employee.php?id=$result[em_id]' onclick='return checkdelete()'>Delete</a></td>
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

