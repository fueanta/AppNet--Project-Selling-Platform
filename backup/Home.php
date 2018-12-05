<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Home</title>
	<script src="../../js/search.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/HomeStyle.css">
</head>
<body>
	<div class="header">
		<div class="logo">
			<label class="logoP1">app</label>
			<label class="logoP2">net</label>
			<div class="accountAccess">
				<?php
					if(isset($_SESSION["f_name"]))
					{
						$fname = $_SESSION["f_name"];
						$lname = $_SESSION["l_name"];
						echo "
						<a href='../user/userPanelPersonalInfo.php' class='signUp'>
							$fname $lname
						</a>
						";
					}
					else if(isset($_SESSION["admin"]))
					{
						echo "
						<a href='../admin/admin_view.php' class='signUp'>
							Admin
						</a>
						";
					}
					else
					{
						echo "<a href='signup.php' class='signUp'>sign up</a>
							<a href='login.php' class='active'>login</a>";
					}
				?>
			</div>
		</div>

	</div>
	<div class="section1">
		<div class="categories">
			<a href="Home.php">Home</a>
			<a href="Windows.php">Windows</a>
			<a href="OSX.php">OS X</a>
			<a href="IOS.php">IOS</a>
			<a href="Android.php">Android</a>
			<a href="Linux.php">Linux</a>
			<div class="autocomplete">
				<input type="submit" name="searchSubmit" value="Submit" class="searchButton">
				<input type="text" id="myInput" name="search" placeholder="search...">
			</div>
		</div>
	</div>
	<div class="section2">
		<div class="advertisement">
			<a href="#"><img src="../../images/advertisement.jpg"></a>
			<div class="centeredText">Get your custom apps today</div>
		</div>
	</div>
	<div class="section3">
		<label class="categoryHeaders">Windows</label>
		<div class="categoryContainerBody">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_project_by_platform('Windows');
				$count = 0;
				while ($row = mysqli_fetch_array($table)) {
					$count++;
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					$price = $row['PRICE'];
					echo "
						<a href='../user/project.php?project=$project_id'>
							<p class='categoryApp'>
								<img src='../../images/icons/$icon'><br/>
								<label>$title</label><br/>
								<label>$$price</label>
							</p>
						</a>
					";
					if ($count == 5) {
						break;
					}
				}
			 ?>
		</div>
		<label class="categoryHeaders">Android</label>
		<div class="categoryContainerBody">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_project_by_platform('Android');
				$count = 0;
				while ($row = mysqli_fetch_array($table)) {
					$count++;
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					$price = $row['PRICE'];
					echo "
						<a href='../user/project.php?project=$project_id'>
							<p class='categoryApp'>
								<img src='../../images/icons/$icon'><br/>
								<label>$title</label><br/>
								<label>$$price</label>
							</p>
						</a>
					";
					if ($count == 5) {
						break;
					}
				}
			 ?>
		</div>
		<label class="categoryHeaders">Linux</label>
		<div class="categoryContainerBody">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_project_by_platform('Linux');
				$count = 0;
				while ($row = mysqli_fetch_array($table)) {
					$count++;
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					$price = $row['PRICE'];
					echo "
						<a href='../user/project.php?project=$project_id'>
							<p class='categoryApp'>
								<img src='../../images/icons/$icon'><br/>
								<label>$title</label><br/>
								<label>$$price</label>
							</p>
						</a>
					";
					if ($count == 5) {
						break;
					}
				}
			 ?>
		</div>
		<label class="categoryHeaders">iOS</label>
		<div class="categoryContainerBody">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_project_by_platform('iOS');
				$count = 0;
				while ($row = mysqli_fetch_array($table)) {
					$count++;
					$project_id = $row['PROJECT_ID'];
					$icon = $row['ICON'];
					$title = $row['TITLE'];
					$price = $row['PRICE'];
					echo "
						<a href='../user/project.php?project=$project_id'>
							<p class='categoryApp'>
								<img src='../../images/icons/$icon'><br/>
								<label>$title</label><br/>
								<label>$$price</label>
							</p>
						</a>
					";
					if ($count == 5) {
						break;
					}
				}
			 ?>
		</div>
	</div>
	<div class="footer">
		<p class="leftFooter">
			contact us:<br/>
			<a href="#"><img src="../../images/fbIcon.png" style="width: 30px;height: 30px;margin: 5px"></a>
			<a href="#"><img src="../../images/gmail.png" style="width: 30px;height: 30px;margin: 5px"></a><br/>
			<label style="margin-top: 150px; display: block;">copyright: 2018 FUENTA BD</label>

		</p>

		<p class="rightFooter">
			<a href="signup.php" class="signUpFooter">sign up</a> for more<br/><br/>
			<a href="#" class="aboutUs">about us</a><br/><br/><br/>
			<label style="font-size: 30px;">APPNET.com</label>
		</p>

	</div>
	<script>
		var projects = new Array();
		<?php
			include_once '../../database/fetch_data.php';
			$table = fetch_project_titles();
			while ($row=mysqli_fetch_array($table))
			{ ?>
				projects.push("<?php echo $row['title']; ?>");
		<?php } ?>



		/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
		autocomplete(document.getElementById("myInput"), projects);
	</script>
</body>
</html>
