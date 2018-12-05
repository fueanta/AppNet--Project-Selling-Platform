<?php
	session_start();
	include_once '../../database/crud_operations.php';
	$project_id = $_SESSION['buyProject'];
  if(!isset($_SESSION["user_id"]))
  {
		echo "<script type='text/javascript'>alert('You must log in first!');
			window.location='project.php?project=$project_id';
			</script>";
  }
	if (isset($_POST['submit']) && isset($_POST['method'])) {
		// code...
		$method = $_POST['method'];
		if ($method == "Card") {
			if ($_SESSION['card']) {
				header('Location:purchaseWithExistingCard.php');
			}
			else {
				header('Location:purchaseWithNewCard.php');
			}
		}
		else {
			$amount = $_SESSION['payableAmount'];
			$balance = $_SESSION["balance"];
			if ($balance - $amount < 0) {
				// not possible
				echo "<script type='text/javascript'>alert('Account Balance is insufficient.')</script>";
			} else {
				// possible
				$buyer = $_SESSION['user_id'];
				$seller = $_SESSION['ownerId'];
				$_SESSION["balance"] = $balance - $amount;
				insert_transaction($buyer, $seller, $project_id, $amount, "Account");
				echo "<script type='text/javascript'>alert('Purchase has been completed!');
					window.location='puchasedProject.php?project=$project_id';
					</script>";
			}
		}
	}
	elseif (isset($_POST['discard'])) {
		// code...
		header('Location:project.php?project=' . $project_id);
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
			<li><a href="userPanelPersonalInfo.php">Account</a></li>
			<li><a href="userPanelProjects.php">Uploads</a></li>
			<li><a href="userPurchasedProjects.php">Purchases</a></li>

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
	<div style="max-width: 600px" class="accountDetails">
		<span class="heading">
					Payment Method
		</span>
		<hr/>
		<form class="" action="buyProject.php" method="post">
      <table border="0">
				<tr>
					<td colspan="2" style="text-align: left; padding-left: 135px;">
						<b style="color:green;">Payable Amount: $<?php echo $_SESSION['payableAmount'];?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: left; padding-left: 90px;">
						<label style="color:red;">How do you wish to buy this project?</label>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: left; padding-left: 65px;">
						<input type="radio" name="method" value="Card">Card (VISA / MASTERCARD)
						<input type="radio" name="method" value="Account">Account
					</td>
				</tr>
				<tr class="gap" />
				<tr>
					<td colspan="2" style="text-align: left; padding-right: 258px;">
						<input type="submit" name="discard" value="Discard">
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
				<tr class="gap" />
			</table>
		</form>
	</div>

</body>
</html>
