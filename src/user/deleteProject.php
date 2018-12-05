<?php
	session_start();
	include_once '../../database/crud_operations.php';
	if (isset($_POST['submit']) && isset($_POST['concent'])) {
		// code...
		$concent = $_POST['concent'];
		$project_id = $_SESSION['project'];

		if ($concent == "yes") {
			// code...
			delete_project($project_id);
			header('Location:userPanelProjects.php');
		}
		else {
			// code...
			header('Location:projectPageUser.php?project=' . $project_id);
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Userpanel</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<body>
	<div class="header" style="text-transform: capitalize;">
		<span style="padding: 30px"> <span style="color: green;">app</span>net</span>
		<ul>
			<li><a href="userPanelProjects.php">Projects</a></li>
			<li><a href="userPanelPersonalInfo.php">Account</a></li>
		</ul>
	</div>
	<div class="nav">
		<div class="categories">
			<a href="../front/home.php">Home</a>
			<a href="../front/Windows.php">Windows</a>
			<a href="../front/IOS.php">IOS</a>
			<a href="../front/Android.php">Android</a>
			<a href="../front/Linux.php">Linux</a>
		</div>
	</div>
	<br> <br>
	<div style="max-width: 600px" class="accountDetails">
		<span class="heading">
					Confirm Delete
		</span>
		<hr/>
		<form class="" action="deleteProject.php" method="post">
      <table>
				<tr>
					<td colspan="2" style="text-align: left; padding-left: 90px;">
						<label style="color:red;">Are you sure to delete this project?</label>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: left; padding-left: 165px;">
						<input type="radio" name="concent" value="yes">Yes
						<input type="radio" name="concent" value="no">No
					</td>
				</tr>
				<tr class="gap" />
				<tr>
					<td colspan="2" style="text-align: left; padding-right: 310px;">
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
				<tr class="gap" />
			</table>
		</form>
	</div>

</body>
</html>
