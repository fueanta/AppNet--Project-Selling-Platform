<?php
	session_start();
	if (!isset($_POST['searchSubmit']) || $_POST['search']=="") {
		header("Location:Home.php");
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
	</div>
	<hr>
	<div class="projects">

		<div class="projectData">
			<br> <br>
			<?php
				include '../../database/fetch_data.php';
				$table = fetch_project_by_search($_POST['search']);
				while ($row = mysqli_fetch_array($table)) {
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					echo "
						<p>
							<a href='../user/project.php?project=" . $project_id . "'><img src='../../images/icons/" . $icon . "'></a><br/>
							" . $title . "
						</p>
					";
				}
			 ?>
		</div>
	</div>
</body>
</html>
