<style>
td
{
	padding:6px;
}
</style>
<?php
include("connect.php");
error_reporting(0);
$query = "SELECT * FROM books";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total!=0)
{
	?>
	<table>
		<tr>
			<th>USBN</th>
			<th>Book_title</th>
			<th>Branch</th>
			<th>Status</th>
			<th>Author</th>
			<th colspan="2">Operations</th>
		</tr>
	<?php
	while($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
			<td>".$result[USBN]."</td>
			<td>".$result[book_title]."</td>
			<td>".$result[branch_id]."</td>
			<td>".$result[status]."</td>
			<td>".$result[author]."</td>
			<td><a href='/insert_books.php'>Edit</a></td>
			<td><a href='/delete_books.php?id=$result[USBN]' onclick='return checkdelete()'>Delete</a></td>
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

