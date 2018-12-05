<?php
	session_start();
	  if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
	  }
	include_once '../../utilities/image_uploader.php';
	include_once '../../database/crud_operations.php';

	if (isset($_POST['uploaded'])) {
		// code...
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
			$project_id = $icon_inf[0];
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
			$title = $_POST['title'];
			$price = $_POST['price'];
			$desc = nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8'));
			$feature = nl2br(htmlentities($_POST['features'], ENT_QUOTES, 'UTF-8'));
			$tools = $_POST['tools'];
			$icon = $icon_name;
			$size = $_POST['size'];
			$link = $_POST['link'];
			$discount = $_POST['discount'];
			$platform = $_POST['platform'];
			$category = $_POST['category'];

			insert_project($project_id, $title, $price, $desc, $feature, $tools, $icon, $size, $link, $discount, $platform, $category, $_SESSION['user_id']);
			insert_snapshot($snaps, $project_id);
			header("Location:userPanelProjects.php");
		}
	}
	elseif (isset($_POST['cancel'])) {
		// code...
		header("Location:userPanelProjects.php");
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
					Project Information
		</span>
		<hr/>
		<form class="" action="uploadProject.php" method="post" enctype="multipart/form-data">
			<table style="padding-right: 400px;">
				<tr>
					<td align="right" style="padding-right: 50px;">Title<label style="color: red;">*</label></td>
					<td><input placeholder="Title of the Project" style="min-width: 245px;" type="text" name="title"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px; padding-bottom: 150px;">Description</td>
					<td><textarea placeholder="Short Description" style="min-width: 245px;" rows="10" name="description"></textarea></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px; padding-bottom: 150px;">Features</td>
					<td><textarea placeholder="Feature list..." style="min-width: 245px;" rows="10" name="features"></textarea></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Link<label style="color: red;">*</label></td>
					<td><input placeholder="Link of the Project" style="min-width: 245px;" type="text" name="link"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">File Size<label style="color: red;">*</label></td>
					<td><input placeholder="Size of the Project File" style="min-width: 245px;" type="text" name="size"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Platform<label style="color: red;">*</label></td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="platform">
							<option disabled selected>
								Choose Project Platform
							</option>
							<option value="Windows">
								Windows
							</option>
							<option value="Android">
								Android
							</option>
							<option value="iOS">
								iOS
							</option>
							<option value="Linux">
								Linux
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Category<label style="color: red;">*</label></td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="category">
							<option disabled selected>
								Choose Project Category
							</option>
							<option value="Personal">
								Personal
							</option>
							<option value="Small Business">
								Small Business
							</option>
							<option value="Enterprise">
								Enterprise
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Tools<label style="color: red;">*</label></td>
					<td><input placeholder="JavaFx, HTML, CSS .." style="min-width: 245px;" type="text" name="tools"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Price<label style="color: red;">*</label></td>
					<td><input placeholder="Price in USD" style="min-width: 245px;" type="text" name="price"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Discount</td>
					<td><input placeholder="%" style="min-width: 245px;" type="text" name="discount"></td>
				</tr>
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
							alert('Project has been uploaded.');
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

	<div class="bottom">
		<div class="bottom-buttons">
			<table>
				<tr>
					<td><a href="userPanelProjects.php">View Uploaded Projects</a></td>
					<td><a href="userPurchasedProjects.php">View Purchased Projects</a></td>
					<td><a href="">Contact Support</a></td>
				</tr>
			</table>
		</div>
	</div>

</body>
</html>
