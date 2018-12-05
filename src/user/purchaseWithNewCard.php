<?php
	session_start();
	include_once '../../database/crud_operations.php';
	include_once '../../database/fetch_data.php';
	$project_id = $_SESSION['buyProject'];

	if (isset($_POST['buy'])) {
		$buyer = $_SESSION['user_id'];
		$seller = $_SESSION['ownerId'];
		$amount = $_SESSION['payableAmount'];
		$card_number = $_POST['cn'];

		insert_transaction($buyer, $seller, $project_id, $amount, "Card: " . $card_number);
		echo "<script type='text/javascript'>alert('Purchase has been completed!');
			window.location='puchasedProject.php?project=$project_id';
			</script>";
	}
	elseif (isset($_POST['discard_changes'])) {
		header("Location:buyProject.php?project=$project_id");
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
		<form class="" action="purchaseWithNewCard.php" method="post">
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
							<input type="submit" name="buy" value="Buy">
						</td>
					</tr>
				</tr>
				<tr class="gap" />
			</table>
		</form>
	</div>
</body>
</html>
