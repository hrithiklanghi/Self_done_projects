<style>
td
{
	padding:6px;
}
</style>
<?php
include("connect.php");
error_reporting(0);
$query = "SELECT * FROM branch";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total != 0)
{
	?>
	<table>
		<tr>
			<th>Branch_Id</th>
			<th>Name</th>
			<th>Manager_Id</th>
			<th colspan="2">Operations</th>
		</tr>
	<?php
	while($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
			<td>".$result[branch_id]."</td>
			<td>".$result[branch_name]."</td>
			<td>".$result[manager_id]."</td>
			<td><a href='/insert_branch.php'>Edit</a></td>
			<td><a href='/delete_branch.php?id=$result[branch_id]' onclick='return checkdelete()'>Delete</a></td>
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

