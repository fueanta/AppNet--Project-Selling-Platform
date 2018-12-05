<?php
	session_start();
	include_once '../../database/crud_operations.php';

	if (isset($_POST['updated'])) {
		$title = $_POST['title'];
		$price = $_POST['price'];
		$desc = nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8'));
		$feature = nl2br(htmlentities($_POST['features'], ENT_QUOTES, 'UTF-8'));
		$tools = $_POST['tools'];
		$size = $_POST['size'];
		$link = $_POST['link'];
		$discount = $_POST['discount'];
		$platform = $_POST['platform'];
		$category = $_POST['category'];
		$project_id = $_SESSION['project'];
		update_project($title, $price, $desc, $feature, $tools, $size, $link, $discount, $platform, $category, $project_id);
		header("Location:projectPageUser.php?project=$project_id");
	}
	elseif (isset($_POST['discard'])) {
		$project_id = $_SESSION['project'];
		header("Location:projectPageUser.php?project=$project_id");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Update Project</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<script>
function validateUpdateForm()
{
    // var title = document.forms["updateForm"]["title"].value;
    // var description = document.forms["updateForm"]["description"].value;
    // var f1 = document.forms["updateForm"]["f1"].value;
    // var f2 = document.forms["updateForm"]["f2"].value;
    // var f3 = document.forms["updateForm"]["f3"].value;
    // var f4 = document.forms["updateForm"]["f4"].value;
    // var f5 = document.forms["updateForm"]["f5"].value;
    // var change = document.forms["updateForm"]["change"].value;
    // var link = document.forms["updateForm"]["link"].value;
    // var size = document.forms["updateForm"]["size"].value;
    // var platform = document.forms["updateForm"]["platform"].value;
    // var category = document.forms["updateForm"]["category"].value;
    // var tags = document.forms["updateForm"]["tags"].value;
    // var t1 = document.forms["updateForm"]["t1"].value;
    // var t2 = document.forms["updateForm"]["t2"].value;
    // var other = document.forms["updateForm"]["other"].value;
    // var price = document.forms["updateForm"]["price"].value;
    // var discount = document.forms["updateForm"]["discount"].value;
    // var s1 = document.forms["updateForm"]["s1"].value;
    // var s2 = document.forms["updateForm"]["s2"].value;
    // var s3 = document.forms["updateForm"]["s3"].value;
    // var s4 = document.forms["updateForm"]["s4"].value;
    // var s5 = document.forms["updateForm"]["s5"].value;
    // if (title == "")
    // {
    //     alert("Title must be filled out");
    //     return false;
    // }
    // else if(title.length > 20)
    // {
    // 	alert("Too much long name must be under 20 charecter");
    //     return false;
    // }
    // else if(description == "")
    // {
    // 	alert("Description must be filled out");
    //     return false;
    // }
    // else if((f1.length > 20) || (f2.length > 20) || (f3.length > 20) || (f4.length > 20) || (f5.length > 20))
    // {
    // 	alert("Too much long feature must be under 20 character");
    //     return false;
    // }
    // else if(change.length > 100)
    // {
    // 	alert("Too much long change data, must be under 100 character");
    //     return false;
    // }
    // else if(link == "")
    // {
    // 	alert("Link can't be empty");
    //     return false;
    // }
    // else if(link.length > 500)
    // {
    // 	alert("Invalid link");
    //     return false;
    // }
    // else if(size == "")
    // {
    // 	alert("File size must be filled out");
    //     return false;
    // }
    // else if(platform == "")
    // {
    // 	alert("Platform must be filled out");
    //     return false;
    // }
    // else if(phone.length > 30)
    // {
    // 	alert("Invalid Platform");
    //     return false;
    // }
    // else if(category == "")
    // {
    // 	alert("Category must be filled out");
    //     return false;
    // }
    // else if(city.length > 20)
    // {
    // 	alert("Too much long category name, must be under 20 charecter");
    //     return false;
    // }
    // else if(tags.length > 30)
    // {
    // 	alert("Too much long tag name, must be under 30 charecter");
    //     return false;
    // }
    // else if(t1 == "" && t2 == "")
    // {
    // 	alert("Tools must be filled out");
    //     return false;
    // }
    // else if(others.length > 30)
    // {
    // 	alert("Invali tools name");
    //     return false;
    // }
    // else if(price == "")
    // {
    // 	alert("Price must be filled out");
    //     return false;
    // }
    // else if(price.length > 10)
    // {
    // 	alert("Invalid price");
    //     return false;
    // }
    // else if(discount.length > 3)
    // {
    // 	alert("Invalid discount");
    //     return false;
    // }
}
</script>

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
		<div style="max-width: 590px" class="accountDetails">
			<span class="heading">
						Project Information
			</span>
			<hr/>
			<form name="updateForm" action='updateProject.php' onsubmit="return validateUpdateForm()" method='post' enctype="multipart/form-data">
				<table style="padding-right: 400px;">
					<?php
					if (isset($_GET['project'])) {
						include_once '../../database/fetch_data.php';
						$project_id = $_GET['project'];
						$_SESSION['project'] = $project_id;
						$row = fetch_project($project_id);
						$title = $row['TITLE'];
						$price = $row['PRICE'];
						$desc = str_replace("<br />","",$row['DESCRIPTION']);
						$features = str_replace("<br />","",$row['FEATURES']);
						$tools = $row['TOOLS'];
						$icon = $row['ICON'];
						$size = $row['SIZE'];
						$link = $row['LINK'];
						$discount = $row['DISCOUNT'];
						$platform = $row['PLATFORM'];
						$category = $row['CATEGORY'];

						echo "
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Title<label style=\"color: red;\">*</label></td>
							<td><input placeholder=\"Title of the Project\" style=\"min-width: 245px;\" type=\"text\" name=\"title\" value=\"$title\"></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px; padding-bottom: 150px;\">Description</td>
							<td><textarea placeholder=\"Short Description\" style=\"min-width: 245px;\" rows=\"10\" name=\"description\">$desc</textarea></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px; padding-bottom: 150px;\">Features</td>
							<td><textarea placeholder=\"Feature list...\" style=\"min-width: 245px;\" rows=\"10\" name=\"features\">$features</textarea></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Link<label style=\"color: red;\">*</label></td>
							<td><input placeholder=\"Link of the Project\" style=\"min-width: 245px;\" type=\"text\" name=\"link\" value=\"$link\"></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">File Size<label style=\"color: red;\">*</label></td>
							<td><input placeholder=\"Size of the Project File\" style=\"min-width: 245px;\" type=\"text\" name=\"size\" value=\"$size\"></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Platform<label style=\"color: red;\">*</label></td>
							<td>
								<select style=\"min-width: 245px; min-height: 23px\" name=\"platform\">
									<option value=\"Windows\" " . ($platform == "Windows" ? "selected" : "") . ">
										Windows
									</option>
									<option value=\"Android\" " . ($platform == "Android" ? "selected" : "") . ">
										Android
									</option>
									<option value=\"iOS\" " . ($platform == "iOS" ? "selected" : "") . ">
										iOS
									</option>
									<option value=\"Linux\" " . ($platform == "Linux" ? "selected" : "") . ">
										Linux
									</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Category<label style=\"color: red;\">*</label></td>
							<td>
								<select style=\"min-width: 245px; min-height: 23px\" name=\"category\">
									<option value=\"Personal\" " . ($category == "Personal" ? "selected" : "") . ">
										Personal
									</option>
									<option value=\"Small Business\" " . ($category == "Small Business" ? "selected" : "") . ">
										Small Business
									</option>
									<option value=\"Enterprise\" " . ($category == "Enterprise" ? "selected" : "") . ">
										Enterprise
									</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Tools<label style=\"color: red;\">*</label></td>
							<td><input placeholder=\"JavaFx, HTML, CSS ..\" style=\"min-width: 245px;\" type=\"text\" name=\"tools\" value=\"$tools\"></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Price<label style=\"color: red;\">*</label></td>
							<td><input placeholder=\"Price in USD\" style=\"min-width: 245px;\" type=\"text\" name=\"price\" value=\"$price\"></td>
						</tr>
						<tr>
							<td align=\"right\" style=\"padding-right: 50px;\">Discount</td>
							<td><input placeholder=\"%\" style=\"min-width: 245px;\" type=\"text\" name=\"discount\" value=\"$discount\"></td>
						</tr>
						<tr>
							<td/>
							<td><a href='updateProjectImages.php?project=$project_id'>Change Snapshots</a></td>
						</tr>
						<tr>
							<td colspan=\"2\" align=\"center\">
								<br/>
								<input onclick=\"update()\" type=\"submit\" name=\"updated\" value=\"Update Project\">
							</td>
							<script type=\"text/javascript\">
								function update() {
									alert('Project has been updated.');
								}
							</script>
						</tr>
						<tr>
							<td colspan=\"2\" align=\"center\">
								<input type=\"submit\" name=\"discard\" value=\"Discard / Back\">
							</td>
						</tr>
						";
					}
					 ?>
				</table>
			</form>
			<br>
		</div>
	<div class="bottom">
		<div class="bottom-buttons">
			<table>
				<tr>
					<td><a href="userPanelProjects.html">View Uploaded Projects</a></td>
					<td><a href="">View Purchased Projects</a></td>
					<td><a href="">Contact Support</a></td>
				</tr>
		</div>
</body>
</html>
