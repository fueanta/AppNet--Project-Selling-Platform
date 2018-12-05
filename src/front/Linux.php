<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Windows</title>
	<script src="../../js/search.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/CategoryStyle.css">
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
					else
					{
						echo "<a href='signup.php' class='signUp'>sign up</a>
							<a href='login.php' class='active'>login</a>";
					}
				?>
			</div>
		</div>
	<div class="section1">
		<div class="categories">
			<a href="Home.php">Home</a>
			<a href="Windows.php">Windows</a>
			<a href="IOS.php">IOS</a>
			<a href="Android.php">Android</a>
			<a href="Linux.php">Linux</a>
			<div class="autocomplete">
				<form class="" action="searchedProjects.php" method="post">
					<input type="submit" name="searchSubmit" value="Search" class="searchButton">
					<input type="text" id="myInput" name="search" placeholder="Search here ...">
				</form>
			</div>
		</div>
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
		autocomplete(document.getElementById("myInput"), projects);
	</script>
	<br> <br>
	<div class="slideshow-container">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_icons_by_platform('Linux');
				while ($row = mysqli_fetch_array($table))
				{
						$icon = $row['ICON'];
						echo "
							<div class='mySlides fade'>
								<img src='../../images/icons/$icon' style='width:100%;height: 500px'>
							</div>
						";
				}
			 ?>
		</div>

		<div style="text-align:center">
		  <span class="dot" onclick="currentSlide(1)"></span>
		  <span class="dot" onclick="currentSlide(2)"></span>
		  <span class="dot" onclick="currentSlide(3)"></span>
		  <span class="dot" onclick="currentSlide(4)"></span>
		</div>
	</div>
	<div class="section3">
		<label class="categoryHeaders">All Linux apps</label>
		<div class="categoryContainerBody">
			<?php
				include_once '../../database/fetch_data.php';
				$table = fetch_project_by_platform('Linux');
				while ($row = mysqli_fetch_array($table)) {
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
				}
			 ?>
		</div>
	</div>

	<script>
	var slideIndex = 0;
	showSlides();

	function showSlides() {
	    var i;
	    var slides = document.getElementsByClassName("mySlides");
	    var dots = document.getElementsByClassName("dot");
	    for (i = 0; i < slides.length; i++) {
	       slides[i].style.display = "none";
	    }
	    slideIndex++;
	    if (slideIndex > slides.length) {slideIndex = 1}
	    for (i = 0; i < dots.length; i++) {
	        dots[i].className = dots[i].className.replace(" active", "");
	    }
	    slides[slideIndex-1].style.display = "block";
	    dots[slideIndex-1].className += " active";
	    setTimeout(showSlides, 2000); // Change image every 2 seconds
	}
	</script>
</body>
</html>
