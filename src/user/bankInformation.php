<?php
	session_start();
	  if(!isset($_SESSION["user_id"]))
	  {
	  	header("Location:../front/home.php");
	  }
	include_once '../../database/crud_operations.php';
	include_once '../../database/fetch_data.php';

	if (isset($_POST['delete_bank'])) {
		$_SESSION['bank'] = null;
		delete_bank_data($_SESSION['user_id']);
		header("Location:userPanelPersonalInfo.php");
	}
	elseif (isset($_POST['update_bank'])) {
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
		update_bank_data($ban, $bac, $acn, $swc, $rcn, $rct, $rcc, $rcct, $rca, $id);
		$_SESSION['bank'] = fetch_bank_info($_SESSION["user_id"]);
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
<script>
function validateBank()
{
    var bank_name = document.forms["bankForm"]["ban"].value;
    var bank_country = document.forms["bankForm"]["bac"].value;
   	var s_code = document.forms["bankForm"]["swc"].value;
    var acc_num = document.forms["bankForm"]["acn"].value;
    var r_name = document.forms["bankForm"]["rcn"].value;
    var r_type = document.forms["bankForm"]["rct"].value;
    var r_country = document.forms["bankForm"]["rcc"].value;
    var r_city = document.forms["bankForm"]["rcct"].value;
    var r_add1 = document.forms["bankForm"]["rca"].value;

    if (bank_name == "")
    {
        alert("Bank_name must be filled out");
        return false;
    }
    else if(bank_name.length > 40)
    {
        alert("Too much long name must be under 40 charecter");
        return false;
    }
    else if (bank_country == "Choose Country")
    {
        alert("Choose a country");
        return false;
    }
    else if(bank_country.length > 30)
    {
        alert("Too much long name must be under 30 charecter");
        return false;
    }
    else if (s_code == "")
    {
        alert("Swift Code must be filled out");
        return false;
    }
    else if(s_code.length > 15 || s_code.length < 5)
    {
        alert("Invalid Swift Code");
        return false;
    }
    else if (acc_num == "")
    {
        alert("Account number must be filled out");
        return false;
    }
    else if(acc_num.length > 15 || acc_num.length < 10)
    {
        alert("Invalid Account Num");
        return false;
    }
    else if (r_name == "")
    {
        alert("Recipent name must be filled out");
        return false;
    }
    else if(r_name.length > 30)
    {
        alert("Too much long recipent name must be under 30 charecter");
        return false;
    }
    else if (r_type == "")
    {
        alert("Recipent type must be filled out");
        return false;
    }
    else if (r_country == "")
    {
        alert("Recipent country must be filled out");
        return false;
    }
    else if (r_city == "")
    {
        alert("Recipent city must be filled out");
        return false;
    }
    else if(r_city.length > 30)
    {
        alert("Too much long recipent city name, must be under 30 charecter");
        return false;
    }
    else if(r_add1.length > 100)
    {
        alert("Too much long recipent Address, must be under 100 charecter");
        return false;
    }
}
</script>
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
					Bank Information
		</span>
		<hr/>
		<form class="" action="bankInformation.php" onsubmit="return validateBank()" method='post' name="bankForm">
			<table style="padding-right: 400px;">
				<tr>
					<td align="right">Bank Name</td>
					<td><input placeholder="Name of the bank" style="min-width: 245px;" type="text" name="ban"
						value="<?php $bank_name = $_SESSION['bank']['bank_name']; echo "$bank_name"; ?>"
					></td>
				</tr>
				<tr>
					<td align="right">Bank Country</td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="bac">
							<option value="Brazil" <?php
							$bank_country = $_SESSION['bank']['bank_country'];
							if ($bank_country == "Brazil") {
								echo "selected";
							}
							?>>
								Brazil
							</option>
							<option value="Bangladesh" <?php
							$bank_country = $_SESSION['bank']['bank_country'];
							if ($bank_country == "Bangladesh") {
								echo "selected";
							}
							?>>
								Bangladesh
							</option>
							<option value="France" <?php
							$bank_country = $_SESSION['bank']['bank_country'];
							if ($bank_country == "France") {
								echo "selected";
							}
							?>>
								France
							</option>
							<option value="United States" <?php
							$bank_country = $_SESSION['bank']['bank_country'];
							if ($bank_country == "United States") {
								echo "selected";
							}
							?>>
								United States
							</option>
							<option value="Russia" <?php
							$bank_country = $_SESSION['bank']['bank_country'];
							if ($bank_country == "Russia") {
								echo "selected";
							}
							?>>
								Russia
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Swift Code</td>
					<td><input placeholder="Swift Code of the bank" style="min-width: 245px;" type="text" name="swc"
						value="<?php $swift_code = $_SESSION['bank']['swift_code']; echo "$swift_code"; ?>"></td>
				</tr>
				<tr>
					<td align="right">Account No</td>
					<td><input placeholder="Put your Account Number" style="min-width: 245px;" type="text" name="acn"
						value="<?php $acc_no = $_SESSION['bank']['account_no']; echo "$acc_no"; ?>"></td>
				</tr>
				<tr>
					<td align="right">Recipent Name</td>
					<td><input placeholder="Name of the recipent" style="min-width: 245px;" type="text" name="rcn"
						value="<?php $var = $_SESSION['bank']['rec_name']; echo "$var"; ?>"></td>
				</tr>
				<tr>
					<td align="right">Recipent Type</td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="rct">
							<option value="Individual" <?php
							$var = $_SESSION['bank']['rec_type'];
							if ($var == "Individual") {
								echo "selected";
							}
							?>>
								Individual
							</option>
							<option value="Corporate Entity" <?php
							$var = $_SESSION['bank']['rec_type'];
							if ($var == "Corporate Entity") {
								echo "selected";
							}
							?>>
								Corporate Entity
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Recipent Country<td>
						<select style="min-width: 245px; min-height: 23px" name="rcc">
							<option value="Brazil" <?php
							$var = $_SESSION['bank']['rec_country'];
							if ($var == "Brazil") {
								echo "selected";
							}
							?>>
								Brazil
							</option>
							<option value="Bangladesh" <?php
							$var = $_SESSION['bank']['rec_country'];
							if ($var == "Bangladesh") {
								echo "selected";
							}
							?>>
								Bangladesh
							</option>
							<option value="France" <?php
							$var = $_SESSION['bank']['rec_country'];
							if ($var == "France") {
								echo "selected";
							}
							?>>
								France
							</option>
							<option value="United States" <?php
							$var = $_SESSION['bank']['rec_country'];
							if ($var == "United States") {
								echo "selected";
							}
							?>>
								United States
							</option>
							<option value="Russia" <?php
							$var = $_SESSION['bank']['rec_country'];
							if ($var == "Russia") {
								echo "selected";
							}
							?>>
								Russia
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Recipent City</td>
					<td><input placeholder="Name of the city of recipent" style="min-width: 245px;" type="text" name="rcct"
						value="<?php $var = $_SESSION['bank']['rec_city']; echo "$var"; ?>"></td>
				</tr>
				<tr>
					<td align="right">Recipent Address</td>
					<td><input placeholder="Recipent Address Line" style="min-width: 245px;" type="text" name="rca"
						value="<?php $var = $_SESSION['bank']['rec_address']; echo "$var"; ?>"></td>
				</tr>
				<tr>
					<td align='center' colspan='2' style="color:red;font-weight: bold;text-align: center;">

						<?php
							$flag=false;
							if(isset($_POST["update_bank"]))
							{
								$flag = true;
								/*if (!preg_match("/^[0-9]*$/",$_POST["acn"]))
								{
									echo "Invalid account number";
									$flag = false;
								}
								else */
								if (!preg_match("/^[a-zA-Z .,-]*$/",$_POST["rcn"]))
								{
									echo "Invalid recipent name";
									$flag = false;
								}
								else if (!preg_match("/^[a-zA-Z .,-]*$/",$_POST["rcct"]))
								{
									echo "Invalid recipent city name";
									$flag = false;
								}
							}
							if($flag)
							{
								$message = "Update successfully";
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td style="padding-right: 0px;" colspan="2" align="right">
						<input type="submit" name="discard_changes" value="Back">
						<input type="submit" name="delete_bank" value="Delete">
						<input type="submit" name="update_bank" value="Update">
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

<?php

	if(isset($_POST["bank_submit"]))
	{
		$flag = true;
		if (!preg_match("/^[0-9]*$/",$_POST["acc_num"]))
		{
			echo "Invalid account number";
			$flag = false;
		}
		else if (!preg_match("/^[a-zA-Z .,-]*$/",$_POST["r_name"]))
		{
			echo "Invalid recipent name";
			$flag = false;
		}
		else if (!preg_match("/^[a-zA-Z .,-]*$/",$_POST["r_city"]))
		{
			echo "Invalid recipent city name";
			$flag = false;
		}
	}
	if($flag)
	{
		echo "okk";
	}
?>
