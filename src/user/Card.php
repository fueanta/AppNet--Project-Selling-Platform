<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
	  }
	include_once '../../database/crud_operations.php';
	include_once '../../database/fetch_data.php';

	if (isset($_POST['delete_card'])) {
		$_SESSION['card'] = null;
		delete_card_data($_SESSION['user_id']);
		header("Location:userPanelPersonalInfo.php");
	}
	elseif (isset($_POST['update_card'])) {
		$cn = is_numeric($_POST['cn']) ? $_POST['cn'] : $_SESSION['card']['card_num'];
		$ch = $_POST['ch'];
		$ed = $_POST['ed'];
		$sn = is_numeric($_POST['sn']) ? $_POST['sn'] : $_SESSION['card']['security_num'];
		update_card_data($cn, $ch, $ed, $sn, $_SESSION['user_id']);
		$_SESSION['card'] = fetch_card_info($_SESSION["user_id"]);
		//header("Location:userPanelPersonalInfo.php");
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
			<a href="../front/home.php" style="color:grey; text-decoration:none;"><span style="padding: 30px"> <span style="color: green;">app</span>net</span></a>
			<ul>
				<li><a href="userPanelProjects.php">Projects</a></li>
				<li><a href="userPanelPersonalInfo.php">Account</a></li>
			</ul>
		</div>
	<br> <br>
	<div style="max-width: 600px" class="accountDetails">
		<span class="heading">
					Card Information
		</span>
		<hr/>
		<form class="" action="card.php" method="post">
      <table style="padding-right: 600px;">
          <tr>
              <td align="right">Card Holder</td>
              <td><input placeholder="Name of the Card Holder" style="min-width: 240px;" type="text" name="ch"
								value="<?php $card_holder = $_SESSION['card']['card_holder']; echo "$card_holder"; ?>"
							required></td>
          </tr>
          <tr>
              <td align="right">Card Number</td>
              <td><input placeholder="Number of the Card" style="min-width: 240px;" type="text" name="cn"
								value="<?php
								$card_number = getModifiedCardNumber(); echo "$card_number";
								function getModifiedCardNumber()
								{
									$card_number = $_SESSION['card']['card_num'];

									$card_number[4] = '*';
									$card_number[5] = '*';
									$card_number[6] = '*';
									$card_number[7] = '*';
									$card_number[8] = '*';
									$card_number[9] = '*';
									$card_number[10] = '*';
									$card_number[11] = '*';
									$card_number[12] = '*';

									return $card_number;
								}
							  ?>"
							required></td>
          </tr>
          <tr>
              <td align="right">Exp. Date</td>
              <td><input placeholder="Exp. Date" style="min-width: 240px;" type="text" name="ed"
								value="<?php $exp_date = $_SESSION['card']['exp_date']; echo "$exp_date"; ?>"
							required></td>
          </tr>
          <tr>
              <td align="right">CVC/CVV</td>
              <td><input placeholder="e.g 123" style="min-width: 130px; max-width: 130px;" type="text" name="sn"
							value="***" required></td>
          </tr>
				<tr>
					<td style="padding-right: 0px;" colspan="2" align="right">
						<input type="submit" name="discard_changes" value="Back">
						<input type="submit" name="delete_card" value="Delete">
						<input type="submit" name="update_card" value="Update">
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
