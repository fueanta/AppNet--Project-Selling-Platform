
<!DOCTYPE html>
<html>
<head>
	<title>Appnet | Admin</title>
	<link rel="stylesheet" type="text/css" href="../../css/AdminDashboardStyle.css">
</head>
<body>

	<div align='center'>
		<span class="heading">
					Users
		</span>		
		<hr/>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<table max-width: 300px;>
				<tr>
					<td>
						From Date (Added)
					</td>
					<td align="left">
						<input style="min-width: 150px;" type="date" name="fromDate">
					</td>
				</tr>
				<tr>
					<td>
						To Date (Added)
					</td>
					<td align="left">
						<input style="min-width: 150px;" type="date" name="toDate">
					</td>
				</tr>
				<tr>
					<td>
						Specify User
					</td>
					<td align="left">
						<input placeholder="User Id, Name, Email.." style="min-width: 150px; min-height: 18px;" type="text" name="searchName" value="">
					</td>
				</tr>
				
				<tr>
					<td align="left"><input type="submit" name="search" value="Search History"></td>
					<td align="left"><input type="submit" name="all_history" value="All History"></td>
				</tr>
				<tr class="gap" />
			</table>	


		</form>
		
		<br> <br>

		<table align="center" style="border-collapse: collapse; min-width: 1000px;" border="1" class="viewUser">
			
			<?php 

			include_once '../../database/fetch_data.php';

			if(isset($_POST["all_history"]))
			{
				echo 
				"<tr>
				<th>User Id</th>
				<th>User Name</th>
				<th>Phone</th>
				<th>Added Time</th>
				<th>Delete User</th>
				</tr>";

				$table=fetch_all_user();

				while ($row=mysqli_fetch_array($table)) {
					$id = $row['USER_ID'];
					echo "
					<tr>
						<td align='center'>" . $row['USER_ID'] . "</td>
						<td align='center'>" . $row['F_NAME']." ".$row['L_NAME']. "</td>
						<td align='center'>" . $row['PHONE'] . "</td>
						<td align='center'>" . $row['ADDED_TIME'] . "</td>
						<td align='center'><a class='button' href=\"admin_view_user.php?del=$id\">Delete</a></td>
					</tr>
					";					
				}
			}
			else if(isset($_POST["search"]))
			{
				if(!empty($_POST["fromDate"]))
				{
					$fromDate=$_POST["fromDate"];
				}
				if(!empty($_POST["toDate"]))
				{
					$toDate=$_POST["toDate"];
				}
				if(!empty($_POST["searchName"]))
				{
					$searchName=$_POST["searchName"];
				}
				if(isset($fromDate) && isset($toDate) && isset($searchName))
				{
					echo 
						"<tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Phone</th>
						<th>Added Time</th>
						<th>Delete User</th>
						</tr>";
						
					$table=fetch_user_by_date_and_identity($fromDate,$toDate,$searchName);

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>" . $row['USER_ID'] . "</td>
							<td align='center'>" . $row['F_NAME']." ".$row['L_NAME']. "</td>
							<td align='center'>" . $row['PHONE'] . "</td>
							<td align='center'>" . $row['ADDED_TIME'] . "</td>
						";
						
					}
				}
				else if(isset($fromDate) && isset($toDate))
				{
					echo 
						"<tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Phone</th>
						<th>Added Time</th>
						<th>Delete User</th>
						</tr>";
						
					$table=fetch_user_by_date($fromDate,$toDate);

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>" . $row['USER_ID'] . "</td>
							<td align='center'>" . $row['F_NAME']." ".$row['L_NAME']. "</td>
							<td align='center'>" . $row['PHONE'] . "</td>
							<td align='center'>" . $row['ADDED_TIME'] . "</td>
						";
						
					}
				}
				else if(isset($searchName))
				{
					echo 
						"<tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Phone</th>
						<th>Added Time</th>
						<th>Delete User</th>
						</tr>";
						
					$table=fetch_user_by_identity($_POST["searchName"]);

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>" . $row['USER_ID'] . "</td>
							<td align='center'>" . $row['F_NAME']." ".$row['L_NAME']. "</td>
							<td align='center'>" . $row['PHONE'] . "</td>
							<td align='center'>" . $row['ADDED_TIME'] . "</td>
						";
						
					}
				}
			}
			
		 	?>	

		</table>
		<br>

		<table align="center" style="min-width: 1000px; border-collapse: collapse;">
		<?php 
			include_once '../../database/fetch_data.php';
			if(isset($_POST["all_history"]))
			{
				$table=fetch_all_user();
			}
			else if(isset($fromDate) && isset($toDate) && isset($searchName))
			{
				$table=fetch_user_by_date_and_identity($fromDate,$toDate,$searchName);
			}
			else if(isset($fromDate) && isset($toDate))
			{
				$table=fetch_user_by_date($fromDate,$toDate);
			}
			else if(isset($searchName))
			{
				$table=fetch_user_by_identity($_POST["searchName"]);
			}
			if(isset($table)){
				echo "
			
				<tr>
					<td align='center'>
						<b><u>Total Count</u></b>
					</td>
				</tr>
				<tr>
					<td align='center'>
						<b>[".$table->num_rows."]</b>
					</td>
				</tr>
				";
			}
			
		 ?>
		 </table>
	</div>
</body>
</html>
<?php
	include_once '../../database/crud_operations.php';
	if(isset($_GET['del']))
	{
		$id = $_GET['del'];
		echo delete_user($id);
	}
?>