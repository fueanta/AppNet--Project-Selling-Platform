<?php
	session_start();
	include_once '../../database/crud_operations.php';

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
					Change Admin Password
		</span>
		<hr/>
		<form class="" action="changeAdminPass.php" method="post">
      <table style="padding-right: 600px;">
          <tr>
              <td align="right">Current Password</td>
              <td><input placeholder="" style="min-width: 240px;" type="text" name="ch" value=""></td>
          </tr>
          <tr>
              <td align="right">New Password</td>
              <td><input placeholder="Number of the Card" style="min-width: 240px;" type="text" name="cn" value=""></td>
          </tr>
          <tr>
              <td align="right">Re-enter Password</td>
              <td><input placeholder="Exp. Date" style="min-width: 240px;" type="text" name="ed" value=""></td>
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
</body>
</html>
