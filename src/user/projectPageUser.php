<?php
	session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|ProjectPage</title>
	<link rel="stylesheet" type="text/css" href="../../css/ProjectPageStyle.css">
</head>
<body>
	<div class="header" style="text-transform: capitalize;">
		<span style="padding: 30px"> <span style="color: green;">app</span>net</span>
		<ul>
			<li><a href="userPanelPersonalInfo.php">Account</a></li>
			<li><a href="userPanelProjects.php">Uploads</a></li>
			<li><a href="userPurchasedProjects.php">Purchases</a></li>

		</ul>
	</div>
	<div class="section1">
		<div class="categories">
			<a href="../front/home.php">Home</a>
			<a href="../front/Windows.php">Windows</a>
			<a href="../front/IOS.php">IOS</a>
			<a href="../front/Android.php">Android</a>
			<a href="../front/Linux.php">Linux</a>
		</div>
	</div>
	<div class="slideshow-container">
		<?php
			include '../../database/fetch_data.php';
			$project_id = $_GET['project'];
			$table = fetch_snapshot($project_id);
			while ($row = mysqli_fetch_array($table)) {
				$snap = $row['FILE_NAME'];
				echo "
					<div class='mySlides fade'>
						<img src='../../images/screenshots/$project_id/$snap' style='width:700px;height:500px;'>
					</div>
				";
			}
		 ?>
	</div>
	<br/>
	<div style="text-align:center">
	  <span class="dot"></span>
	  <span class="dot"></span>
	  <span class="dot"></span>
	  <span class="dot"></span>
	  <span class="dot"></span>
	</div><br/>
	<div class="projectInfo">
		<?php
			include_once '../../database/fetch_data.php';
			$project_id = $_GET['project'];
			$_SESSION['project'] = $project_id;
			$row = fetch_project($project_id);
			$title = $row['TITLE'];
			$price = $row['PRICE'];
			$desc = $row['DESCRIPTION'];
			$features = $row['FEATURES'];
			$tools = $row['TOOLS'];
			$icon = $row['ICON'];
			$size = $row['SIZE'];
			$link = $row['LINK'];
			$discount = $row['DISCOUNT'];
			$platform = $row['PLATFORM'];
			$category = $row['CATEGORY'];
			$up_vote = $row['UP_VOTE'];
			$down_vote = $row['DOWN_VOTE'];
			$total_vote = ($up_vote + $down_vote) == 0 ? 1 : ($up_vote + $down_vote);
			$rating = (int)(($up_vote / $total_vote) * 100);
			$date_time = $row['TIME_ADDED'];
			$owner_name = $row['F_NAME'] . ' ' . $row['L_NAME'];
			echo "
				<img src=\"../../images/icons/$icon\" style=\"width: 250px;height: 250px;\">
				<label class=\"projectHeader\">$title</label><br/>
				<label style=\"padding-top: 10px;\">By <b>$owner_name</b></label><br/>
				<label class=\"projectInfoTxt\">Price: $$price, " . ($discount != 0 ? "<b>$discount% OFF!</b>" : "No offer available.") . "</label><br>
				<label class=\"projectInfoTxt\">" . ($rating == 0 ? " Not Rated Yet!" : " Rating: $rating%") . "</label>
				<a href=\"updateProject.php?project=$project_id\"><button class=\"firstbtn\">Update</button></a>
				<a href=\"deleteProject.php\"><button>Delete</button></a>

				<button onclick=\"getLink()\">Get</button>
				<p id=\"link\"></p>
				<script type=\"text/javascript\">
					function getLink() {
						document.getElementById(\"link\").innerHTML = \"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='$link'>Project Link</a>\";
					}
				</script>
			</div>
			<div class=\"projectDescription\">
				<div class=\"info\">
					<label class=\"heading\">Description</label><br/>
					<p style=\"font-size: 20px; width: 100%;background: white;\">
						$desc
					</p>
				</div> <br/>
				<div class=\"info\">
					<label class=\"heading\">Features</label><br/>
					<p style=\"font-size: 20px; width: 100%;background: white;\">
						$features
					</p>
				</div>
				<div class=\"info\" style=\"height: 150px;\">
					<label class=\"heading\">Platform</label><br/>
					<p style=\"font-size: 20px;height: 100px; width: 100%;background: white;\">
						- $platform
					</p>
				</div>
				<div class=\"info\" style=\"height: 150px;\">
					<label class=\"heading\">Category</label><br/>
					<p style=\"font-size: 20px;height: 100px; width: 100%;background: white;\">
						- $category
					</p>
				</div>
				<div class=\"info\" style=\"height: 150px;\">
					<label class=\"heading\">Tools</label><br/>
					<p style=\"font-size: 20px;height: 100px; width: 100%;background: white;\">
						- $tools
					</p>
				</div>
				<div class=\"info\" style=\"height: 150px;\">
					<label class=\"heading\">Project size</label><br/>
					<p style=\"font-size: 20px;height: 100px; width: 100%;background: white;\">
						$size
					</p>
				</div>
				<div class=\"info\" style=\"height: 150px;\">
					<label class=\"heading\">Added</label><br/>
					<p style=\"font-size: 20px;height: 100px; width: 100%;background: white;\">
						$date_time
					</p>
				</div>
			";
		 ?>
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
