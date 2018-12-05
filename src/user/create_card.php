<?php
	session_start();
	include_once '../../database/crud_operations.php';
	if (isset($_POST['add_card'])) {
		insert_card_data($_POST['cn'], $_POST['ch'], $_POST['ed'], $_POST['sn'], $_SESSION['user_id']);
		//$_SESSION['card'] = fetch_card_info($_SESSION["user_id"]);
		header("Location:userPanelPersonalInfo.php");
	}
	elseif (isset($_POST['discard_changes'])) {
		header("Location:userPanelPersonalInfo.php");
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
			<li><a href="userPanelProjects.html">Projects</a></li>
			<li><a href="userPanelPersonalInfo.html">Account</a></li>
		</ul>
	</div>
	<div class="nav">
		<div class="categories">
			<a href="../front/home.php">Home</a>
			<a href="../front/Windows.php">Windows</a>
			<a href="../front/IOS.php">IOS</a>
			<a href="../front/Android.php">Android</a>
			<a href="../front/Linux.php">Linux</a>
			<input type="submit" name="searchSubmit" value="Submit" class="searchButton">
			<input type="text" name="search" placeholder="search...">
		</div>
	</div>
	<br> <br>
	<div style="max-width: 600px" class="accountDetails">
		<span class="heading">
					Card Information
		</span>
		<hr/>
		<form class="" action="create_card.php" method="post">
      <table style="padding-right: 600px;">
          <tr>
              <td align="right">Card Holder</td>
              <td><input placeholder="Name of the Card Holder" style="min-width: 240px;" type="text" name="ch" value=""></td>
          </tr>
          <tr>
              <td align="right">Card Number</td>
              <td><input placeholder="Number of the Card" style="min-width: 240px;" type="text" name="cn" value=""></td>
          </tr>
          <tr>
              <td align="right">Exp. Date</td>
              <td><input placeholder="Exp. Date" style="min-width: 240px;" type="text" name="ed" value=""></td>
          </tr>
          <tr>
              <td align="right">CVC/CVV</td>
              <td><input placeholder="e.g 123" style="min-width: 130px; max-width: 130px;" type="text" name="sn" value=""></td>
          </tr>
				<tr>
					<tr>
						<td style="padding-right: 0px;" colspan="2" align="right">
							<input type="submit" name="discard_changes" value="Back">
							<input type="submit" name="add_card" value="Add">
						</td>
					</tr>
				</tr>
				<tr class="gap" />
			</table>
		</form>
	</div>

	<div class="bottom">
		<div class="bottom-buttons">
			<table>
				<tr>
					<td><a href="userPanelProjects.html">View Uploaded Projects</a></td>
					<td><a href="">View Purchased Projects</a></td>
					<td><a href="">Contact Support</a></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
