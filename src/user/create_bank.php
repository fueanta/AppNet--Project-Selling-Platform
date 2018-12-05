<?php
	session_start();
	include_once '../../database/crud_operations.php';
	if (isset($_POST['add_bank'])) {
		$ban = $_POST['ban'];
		$bac = $_POST['bac'];
		$acn = $_POST['acn'];
		$swc = $_POST['swc'];
		$rcn = $_POST['rcn'];
		$rct = $_POST['rct'];
		$rcc = $_POST['rcc'];
		$rcct = $_POST['rcct'];
		$rca = $_POST['rca'];
		$id = $_SESSION['user_id'];
		insert_bank_data($ban, $bac, $acn, $swc, $rcn, $rct, $rcc, $rcct, $rca, $id);
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
					Bank Information
		</span>
		<hr/>
		<form class="" action="" method="post">
			<table style="padding-right: 400px;">
				<tr>
					<td align="right">Bank Name</td>
					<td><input placeholder="Name of the bank" style="min-width: 245px;" type="text" name="ban" value=""></td>
				</tr>
				<tr>
					<td align="right">Bank Country</td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="bac">
							<option disabled selected>
								Choose Country
							</option>
							<option value="Bangladesh">
								Bangladesh
							</option>
							<option value="Brazil">
								Brazil
							</option>
							<option value="France">
								France
							</option>
							<option value="United States">
								United States
							</option>
							<option value="Russia">
								Russia
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Swift Code</td>
					<td><input placeholder="Swift Code of the bank" style="min-width: 245px;" type="text" name="swc" value=""></td>
				</tr>
				<tr>
					<td align="right">Account No</td>
					<td><input placeholder="Put your Account Number" style="min-width: 245px;" type="text" name="acn" value=""></td>
				</tr>
				<tr>
					<td align="right">Recipent Name</td>
					<td><input placeholder="Name of the recipent" style="min-width: 245px;" type="text" name="rcn" value=""></td>
				</tr>
				<tr>
					<td align="right">Recipent Type</td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="rct">
							<option disabled selected>
								Choose Recipent Type
							</option>
							<option value="Individual">
								Individual
							</option>
							<option value="Corporate Entity">
								Corporate Entity
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Recipent Country<td>
						<select style="min-width: 245px; min-height: 23px" name="rcc">
							<option disabled selected>
								Choose Country
							</option>
							<option value="Bangladesh">
								Bangladesh
							</option>
							<option value="Brazil">
								Brazil
							</option>
							<option value="France">
								France
							</option>
							<option value="United States">
								United States
							</option>
							<option value="Russia">
								Russia
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Recipent City</td>
					<td><input placeholder="Name of the city of recipent" style="min-width: 245px;" type="text" name="rcct" value=""></td>
				</tr>
				<tr>
					<td align="right">Recipent Address</td>
					<td><input placeholder="Recipent Address Line" style="min-width: 245px;" type="text" name="rca" value=""></td>
				</tr>
				<tr>
					<td style="padding-right: 0px;" colspan="2" align="right">
						<input type="submit" name="discard_changes" value="Back">
						<input type="submit" name="add_bank" value="Add">
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
					<td><a href="userPanelProjects.html">View Uploaded Projects</a></td>
					<td><a href="">View Purchased Projects</a></td>
					<td><a href="">Contact Support</a></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
