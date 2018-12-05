 <?php
  session_start();
  if(!isset($_SESSION["user_id"]))
  {
  	header("Location:../front/home.php");
  }
 	include '../../database/fetch_data.php';
 	$_SESSION['card'] = fetch_card_info($_SESSION["user_id"]);
 	$_SESSION['bank'] = fetch_bank_info($_SESSION["user_id"]);
  $_SESSION['transferred'] = false;
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Userpanel</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<body>
	<form action="logout.php">
	<div class="header" style="text-transform: capitalize;">
		<a href="../front/home.php" style="color:grey; text-decoration:none;"><span style="padding: 30px"> <span style="color: green;">app</span>net</span></a>

		<ul>
			<li><input type='submit' name='logout_action', value= 'logout'></li>
			<li><a href="userPanelProjects.php">Projects</a></li>
			<li><a href="userPanelPersonalInfo.php">Account</a></li>

		</ul>
	</div>
	</form>
	<br> <br>
	<div class="accountDetails">
		<span class="heading">
					Personal Information
		</span>
		<hr/>
		<table>
			<tr>
				<td>Name</td>
				<td>
					<?php
						echo $_SESSION["f_name"] . ' ' . $_SESSION["l_name"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<?php
						echo $_SESSION["email"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>************</td>
			</tr>
			<tr>
				<td>Date of birth</td>
				<td>
					<?php
						echo $_SESSION["dob"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>Phone</td>
				<td>
					<?php
						echo $_SESSION["phone"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>Country</td>
				<td>
					<?php
						echo $_SESSION["country"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td>
					<?php
						echo $_SESSION["city"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>State</td>
				<td>
					<?php
						echo $_SESSION["state"];
					 ?>
				</td>
			</tr>
			<tr>
				<td>Postal code</td>
				<td>
					<?php
						echo $_SESSION["p_code"];
					 ?>
				</td>
			</tr>
			<tr>
				<td align="left"><a href="updateUser.php"><input type="button" name="" value="Change"></a>
			</tr>
		</table>
		<span class="heading">
					Card Information
		</span>
		<hr/>
			<?php
				if ($_SESSION['card'])
				{
					echo "
					<table>
						<tr>
							<td>Card type</td>
							<td colspan='2' align='left'>
								" . getCardType() . "
							</td>
						</tr>
						<tr>
							<td>Card no</td>
							<td colspan='2' align='left'>
								" . getModifiedCardNumber() . "
							</td>
						</tr>
						<tr>
							<td align='left'><a href='card.php'><input type='button' name='' value='Change'></a>
						</tr>
					</table>
					";
				}
				else
				{
					echo "
					<table>
						<tr>
							<td align=\"left\">No card has been added yet.</td>
						</tr>
						<tr>
							<td align=\"left\"><a href=\"create_card.php\"><input type=\"button\" name=\"\" value=\"Add a card\"></a>
							</td>
						</tr>
					</table>
					";
				}

				function getCardType()
				{
					$card_number = $_SESSION['card']['card_num'];
					if ($card_number[0] == '4')
						return "VISA";
					else if ($card_number[0] == '5' && ($card_number[1] == '2' || $card_number[1] == '3' || $card_number[1] == '4' || $card_number[1] == '5'))
						return "mastercard";
				}

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
			 ?>
		<span class="heading">
					Bank Information
		</span>
		<hr/>
			<?php
				if ($_SESSION['bank'])
				{
					echo "
					<table>
						<tr>
							<td>Bank Name</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['bank_name'] . "
							</td>
						</tr>
						<tr>
							<td>Bank Country</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['bank_country'] . "
							</td>
						</tr>
						<tr>
							<td>Swift Code</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['swift_code'] . "
							</td>
						</tr>
						<tr>
							<td>Account No</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['account_no'] . "
							</td>
						</tr>
						<tr>
							<td>Recipent Name</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['rec_name'] . "
							</td>
						</tr>
						<tr>
							<td>Recipent Type</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['rec_type'] . "
							</td>
						</tr>
						<tr>
							<td>Recipent Country</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['rec_country'] . "
							</td>
						</tr>
						<tr>
							<td>Recipent City</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['rec_city'] . "
							</td>
						</tr>
						<tr>
							<td>Recipent Address</td>
							<td colspan='2' align='left'>
								" . $_SESSION['bank']['rec_address'] . "
							</td>
						</tr>
						<tr>
							<td align='left'><a href='bankInformation.php'><input type='button' name='' value='Change'></a>
						</tr>
					</table>
					";
				}
				else
				{
					echo "
					<table>
						<tr>
							<td align=\"left\">No bank has been added yet.</td>
						</tr>
						<tr>
							<td align=\"left\"><a href=\"create_bank.php\"><input type=\"button\" name=\"\" value=\"Add an account\"></a>
							</td>
						</tr>
					</table>
					";
				}
			 ?>
		<span class="heading">
					Account Information
		</span>
		<hr/>
		<table>
			<tr>
				<td>Account Balance</td>
				<td align="left">
					<?php
						echo '$' . $_SESSION["balance"];
					 ?>
				</td>
			</tr>
			<tr>
				<td align="left"><a href="transferBalance.php"><input type="button" name="" value="Transfer"></a>
			</tr>
			<tr class="gap" />
		</table>
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
