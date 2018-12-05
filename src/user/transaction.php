<?php
	session_start();
	  if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
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
	<div style="min-width: 800px;" class="accountDetails">
		<span class="heading">
					Transaction History
		</span>
		<hr/>
		<form class="" action="transaction.php" method="post">
			<table style="padding-left: 170px;">
				<tr>
					<td>
						From Date
					</td>
					<td align="center">
						<input style="min-width: 145px;" type="date" name="from" value="<?php echo date("Y-m-d"); ?>">
					</td>
				</tr>
				<tr>
					<td>
						To Date
					</td>
					<td align="center">
						<input style="min-width: 145px;" type="date" name="to" value="<?php echo date("Y-m-d"); ?>">
					</td>
				</tr>
				<tr>
					<td align="left"><input type="submit" name="history" value="Show History"></td>
				</tr>
				<tr class="gap" />
			</table>
		</form>
		<?php
			include_once '../../database/fetch_data.php';
			if (isset($_POST['history'])) {
				echo "<h2>(-) Purchase History</h2>";
				$from = $_POST['from'];
				$to = $_POST['to'];
				$table = fetch_purchase($from, $to, $_SESSION['user_id']);
				if ($row = mysqli_fetch_array($table)) {
					$total = $row['SELLING_PRICE'];
					$name = $row['F_NAME'] . ' ' . $row['L_NAME'];
					echo "
					<table style='border-collapse: collapse; min-width: 800px;' border='1'>
						<tr>
							<th>Project Name</th>
							<th>Project Owner</th>
							<th>Date & Time</th>
							<th>Price</th>
						</tr>
						<tr>
							<td align='center'>" . $row['TITLE'] . "</td>
							<td align='center'>" . $name . "</td>
							<td align='center'>" . $row['TRANSACTION_TIME'] . "</td>
							<td align='center'>" . "$" . $row['SELLING_PRICE'] . "</td>
						</tr>
					";
					while ($row = mysqli_fetch_array($table)) {
						$total += $row['AMOUNT'];
						$name = $row['F_NAME'] . ' ' . $row['L_NAME'];
						echo "
							<tr>
								<td align='center'>" . $row['TITLE'] . "</td>
								<td align='center'>" . $name . "</td>
								<td align='center'>" . $row['TRANSACTION_TIME'] . "</td>
								<td align='center'>" . "$" . $row['SELLING_PRICE'] . "</td>
							</tr>
						";
					}
					echo "
					<tr class='gap' />
				</table>

				<table style='min-width: 800px; border-collapse: collapse;'>
					<tr>
						<td align='center'>
							<b style='color: green;'><u>Total Amount</u></b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<b>$$total</b>
						</td>
					</tr>
				</table>
				";
				}
				else {
					echo "<h3 style='color: red;'># No Purchase had been made from Date: $from to Date: $to.</h3> <br/>";
				}
			}
		 ?>
		<?php
			include_once '../../database/fetch_data.php';
			if (isset($_POST['history'])) {
				echo "<h2>(+) Sale History</h2>";
				$from = $_POST['from'];
				$to = $_POST['to'];
				$table = fetch_sale($from, $to, $_SESSION['user_id']);
				if ($row = mysqli_fetch_array($table)) {
					$total = $row['SELLING_PRICE'];
					$name = $row['F_NAME'] . ' ' . $row['L_NAME'];
					echo "
					<table style='border-collapse: collapse; min-width: 800px;' border='1'>
						<tr>
							<th>Project Name</th>
							<th>Project Buyer</th>
							<th>Date & Time</th>
							<th>Price</th>
						</tr>
						<tr>
							<td align='center'>" . $row['TITLE'] . "</td>
							<td align='center'>" . $name . "</td>
							<td align='center'>" . $row['TRANSACTION_TIME'] . "</td>
							<td align='center'>" . "$" . $row['SELLING_PRICE'] . "</td>
						</tr>
					";
					while ($row = mysqli_fetch_array($table)) {
						$total += $row['AMOUNT'];
						$name = $row['F_NAME'] . ' ' . $row['L_NAME'];
						echo "
							<tr>
								<td align='center'>" . $row['TITLE'] . "</td>
								<td align='center'>" . $name . "</td>
								<td align='center'>" . $row['TRANSACTION_TIME'] . "</td>
								<td align='center'>" . "$" . $row['SELLING_PRICE'] . "</td>
							</tr>
						";
					}
					echo "
					<tr class='gap' />
				</table>

				<table style='min-width: 800px; border-collapse: collapse;'>
					<tr>
						<td align='center'>
							<b style='color: green;'><u>Total Amount</u></b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<b>$$total</b>
						</td>
					</tr>
				</table>
				";
				}
				else {
					echo "<h3 style='color: red;'># No Sale had been made from Date: $from to Date: $to.</h3> <br/>";
				}
			}
		 ?>
	</div>

	<div class="bottom">
		<div class="bottom-buttons">
			<table>
				<tr>
					<td><a href="userPanelProjects.php">View Uploaded Projects</a></td>
					<td><a href="userPurchasedProjects.php">View Purchased Projects</a></td>
					<td><a href="mailto:support@appnet.com?Subject=Request%20for%20support%20from%20USER-ID:%201001&body=Write%20your%20query%20here...">Contact Support</a></td>
				</tr>
			</table>
		</div>
	</div>

</body>
</html>
