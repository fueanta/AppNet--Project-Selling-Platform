<?php
	session_start();
	  if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
	  }
	include_once '../../utilities/image_uploader.php';
	include_once '../../database/crud_operations.php';

	if (isset($_GET['project'])) {
		// code...
		$_SESSION['deleteProject'] = $_GET['project'];
	}

	if (isset($_POST['uploaded'])) {
		// code...
		$project_id = $_SESSION['deleteProject'];
		$insertOK = true;

		$icon_inf = null;
		$ss1_inf = null;
		$ss2_inf = null;
		$ss3_inf = null;
		$ss4_inf = null;
		$ss5_inf = null;
		$project_id = null;

		$snaps = array();

		if ($_FILES["project_icon"]["error"] == 0) {
			$icon_inf = upload_image($_FILES['project_icon'], "icons");
			$project_id = $_SESSION['deleteProject'];
			$icon_name = $icon_inf[1];

	   	if ($_FILES["snap1"]["error"] == 0) {
				$ss1_inf = upload_image($_FILES['snap1'], "screenshots/" . $project_id);
				array_push($snaps, $ss1_inf[1]);
	    }
			if ($_FILES["snap2"]["error"] == 0) {
				$ss2_inf = upload_image($_FILES['snap2'], "screenshots/" . $project_id);
				array_push($snaps, $ss2_inf[1]);
	    }
			if ($_FILES["snap3"]["error"] == 0) {
				$ss3_inf = upload_image($_FILES['snap3'], "screenshots/" . $project_id);
				array_push($snaps, $ss3_inf[1]);
	    }
			if ($_FILES["snap4"]["error"] == 0) {
				$ss4_inf = upload_image($_FILES['snap4'], "screenshots/" . $project_id);
				array_push($snaps, $ss4_inf[1]);
	    }
			if ($_FILES["snap5"]["error"] == 0) {
				$ss5_inf = upload_image($_FILES['snap5'], "screenshots/" . $project_id);
				array_push($snaps, $ss5_inf[1]);
	    }
		}
		else {
			$insertOK = false;
		}

		if ($insertOK == true) {
			// code...
			$project_id = $_SESSION['deleteProject'];
			delete_snapshot($project_id);
			insert_snapshot($snaps, $project_id);
			header("Location:updateProject.php?project=$project_id");
		}
	}
	elseif (isset($_POST['cancel'])) {
		// code...
		$project_id = $_SESSION['deleteProject'];
		header("Location:updateProject.php?project=$project_id");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Upload Project</title>
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
	<br> <br>
	<div style="max-width: 590px" class="accountDetails">
		<span class="heading">
					Re-upload Icon and Scnapshots
		</span>
		<hr/>
		<form class="" action="updateProjectImages.php" method="post" enctype="multipart/form-data">
			<table style="padding-right: 400px;">
				<tr>
					<td align="right" style="padding-right: 50px;">Icon<label style="color: red;">*</label></td>
					<td><input style="min-width: 245px;" type="file" name="project_icon" id="project_icon" accept="image/*"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Snapshots<label style="color: red;">*</label></td>
					<td><input style="min-width: 245px;" type="file" name="snap1" id="snap1" accept="image/*"></td>
				</tr>
				<tr>
					<td/>
					<td><input style="min-width: 245px;" type="file" name="snap2" id="snap2" accept="image/*"></td>
				</tr>
				<tr>
					<td/>
					<td><input style="min-width: 245px;" type="file" name="snap3" id="snap3" accept="image/*"></td>
				</tr>
				<tr>
					<td/>
					<td><input style="min-width: 245px;" type="file" name="snap4" id="snap4" accept="image/*"></td>
				</tr>
				<tr>
					<td/>
					<td><input style="min-width: 245px;" type="file" name="snap5" id="snap5" accept="image/*"></td>
				</tr>
				<tr class="gap" />

				<tr>
					<td colspan="2" align="left">
						<input onclick="upload()" type="submit" name="uploaded" value="Upload Project">
					</td>
					<script type="text/javascript">
						function upload() {
							alert('Snapshots have been updated.');
						}
					</script>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<input type="submit" name="cancel" value="Cancel Upload">
					</td>
				</tr>
				<tr class="gap" />
			</table>
		</form>

	</div>

</body>
</html>
