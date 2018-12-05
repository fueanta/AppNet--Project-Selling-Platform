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
	<div class="accountDetails">
		<span class="heading">
					Transfer Balance
		</span>
		<hr/>
		<form class="" action="transferBalance.php" method="post">
			<table>
				<tr>
					<td>Account Balance</td>
					<td align="left">
						<?php echo "$" . $_SESSION['balance']; ?>
					</td>
				</tr>
				<tr>
					<td>Transfer To</td>
					<td align="left">
						<select style="min-width: 145px; min-height: 23px" name="method" required>
							<option disabled selected>
								Transfer Method
							</option>
							<?php
								if ($_SESSION['bank']) {
									// code...
									$bn = $_SESSION['bank']['bank_name'];
									echo "
									<option value=" . "Bank Account" . ">" .
										$bn .
									"</option>";
								}
								if ($_SESSION['card']) {
									// code...
									$card_type = getCardType();
									echo "
									<option value=" . "Card Account" . ">" .
										$card_type .
									"</option>";
								}
								function getCardType()
								{
									$card_number = $_SESSION['card']['card_num'];
									if ($card_number[0] == '4')
										return "VISA";
									else if ($card_number[0] == '5' && ($card_number[1] == '2' || $card_number[1] == '3' || $card_number[1] == '4' || $card_number[1] == '5'))
										return "mastercard";
								}
							 ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Transfer Amount</td>
					<td align="left"><input placeholder="Amount in USD" style="min-width: 145px;" type="text" name="amount" required></td>
				</tr>
				<tr>
					<td>Short Note</td>
					<td align="left"><input placeholder="Note down purpose" style="min-width: 145px;" type="text" name="note"></td>
				</tr>
				<tr>
					<td align="left"><input type="submit" name="transfer" value="Transfer Balance"></td>
				</tr>
				<tr>
					<td colspan="2">
						<?php
							include_once '../../database/crud_operations.php';
							if (isset($_POST['transfer'])) {
								if (isset($_POST['method']) && is_numeric($_POST['amount'])) {
									// code...
									if ($_POST['amount'] <= 10) {
										// code...
										echo "<b style='color: red;'>Transfer Amount should be greater than $10.</b>";
									}
									elseif ($_SESSION['balance'] - $_POST['amount'] <= 10) {
										// code...
										echo "<b style='color: red;'>Minimum balance should be $10.</b>";
									}
									else {
										// code...
										$amount = $_POST['amount'];
										$note = $_POST['note'];

										$_SESSION['method'] = $_POST['method'];
										$_SESSION['balance'] = $_SESSION['balance'] - $amount;
										$_SESSION['transferred'] = true;

										$acc_num = ($_SESSION['method'] == "Bank" ? $_SESSION['bank']['account_no'] : $_SESSION['card']['card_num']);

										insert_transfer_data(($_SESSION['method'] == "Bank" ? "Bank Account" : "Card"), $acc_num, $amount, $note, $_SESSION['user_id']);
										header("Location:transferBalance.php");
									}
								}
								else {
									// code...
									echo "<b style='color: red;'>Transfer Method has not been selected.</b>";
								}
							}
							elseif ($_SESSION['transferred']) {
								// code...
								$method = $_SESSION['method'];
								echo "<b style='color: green;'>Balance has been transferred to your $method" . ($method == "Bank" ? " Account" : "") . ".</b>";
								$_SESSION['transferred'] = false;
							}
						 ?>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<br> <br>
	<div style="min-width: 800px;" class="accountDetails">
		<span class="heading">
					Transfer History
		</span>
		<hr/>
		<form class="" action="transferBalance.php" method="post">
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
		<br> <br>
		<?php
			include_once '../../database/fetch_data.php';
			if (isset($_POST['history'])) {
				$from = $_POST['from'];
				$to = $_POST['to'];
				$table = fetch_transfer_for_user($from, $to, $_SESSION['user_id']);
				if ($row = mysqli_fetch_array($table)) {
					echo "<h3 style='color: green;'># Transfer History from Date: $from to Date: $to :</h3>";
					$total = $row['AMOUNT'];
					echo "
					<table style='border-collapse: collapse; min-width: 800px;' border='1'>
						<tr>
							<th>Transfer Id</th>
							<th>Transferred To</th>
							<th style='width: 170px;'>A/C or Card No.</th>
							<th>Amount</th>
							<th>Date & Time</th>
							<th>Short Note</th>
						</tr>
						<tr>
							<td align='center'>" . $row['TRANSFER_ID'] . "</td>
							<td align='center'>" . $row['TRANSFERRED_TO'] . "</td>
							<td align='center'>" . $row['ACC_CARD_NUM'] . "</td>
							<td align='center'>" . "$" . $row['AMOUNT'] . "</td>
							<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
							<td align='center'>" . $row['SHORT_NOTE'] . "</td>
						</tr>
					";
					while ($row = mysqli_fetch_array($table)) {
						$total += $row['AMOUNT'];
						echo "
							<tr>
								<td align='center'>" . $row['TRANSFER_ID'] . "</td>
								<td align='center'>" . $row['TRANSFERRED_TO'] . "</td>
								<td align='center'>" . $row['ACC_CARD_NUM'] . "</td>
								<td align='center'>" . "$" . $row['AMOUNT'] . "</td>
								<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
								<td align='center'>" . $row['SHORT_NOTE'] . "</td>
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
					echo "<h3 style='color: red;'># No transfer had been made from Date: $from to Date: $to.</h3> <br/>";
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
					<td><a href="transaction.php">View In/Out Transactions</a></td>
					<td><a href="mailto:support@appnet.com?Subject=Request%20for%20support%20from%20USER-ID:%201001&body=Write%20your%20query%20here...">Contact Support</a></td>
				</tr>
			</table>
		</div>
	</div>

</body>
</html>
