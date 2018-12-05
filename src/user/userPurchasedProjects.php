<?php
	session_start();
	  if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
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
			<a href="../front/home.php" style="color:grey; text-decoration:none;"><span style="padding: 30px"> <span style="color: green;">app</span>net</span></a>
			<ul>
				<li><a href="userPanelProjects.php">Projects</a></li>
				<li><a href="userPanelPersonalInfo.php">Account</a></li>
			</ul>
	</div>
	<hr>
	<div class="projects">
		<span class="heading">
					All Purchased Projects
		</span>
		<div class="projectData">
			<br> <br>
			<?php
				include '../../database/fetch_data.php';
				$table = fetch_purchased_project_for_user($_SESSION['user_id']);
				while ($row = mysqli_fetch_array($table)) {
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					echo "
						<p>
							<a href='puchasedProject.php?project=" . $project_id . "'><img src='../../images/icons/" . $icon . "'></a><br/>
							" . $title . "
						</p>
					";
				}
			 ?>
		</div>
	</div>
</body>
</html>
