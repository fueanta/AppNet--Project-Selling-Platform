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
<script>
function validateUpdateForm()
{
    var f_name = document.forms["updateForm"]["f_name"].value;
    var l_name = document.forms["updateForm"]["l_name"].value;
    var email = document.forms["updateForm"]["email"].value;
    var pass = document.forms["updateForm"]["password"].value;
    var dob = document.forms["updateForm"]["dob"].value;
    var phone = document.forms["updateForm"]["phone"].value;
    var country = document.forms["updateForm"]["country"].value;
    var city = document.forms["updateForm"]["city"].value;
    var state = document.forms["updateForm"]["state"].value;
    var postal = document.forms["updateForm"]["postal"].value;

    if (f_name == "")
    {
        alert("First Name must be filled out");
        return false;
    }
    else if(f_name.length > 30)
    {
    	alert("Too much long name must be under 30 charecter");
        return false;
    }
    else if (l_name == "")
    {
        alert("Last Name must be filled out");
        return false;
    }
    else if(l_name.length > 30)
    {
    	alert("Too much long name must be under 30 charecter");
        return false;
    }
    else if(email == "")
    {
    	alert("Email must be filled out");
        return false;
    }
    else if(pass == "")
    {
    	alert("Password must be filled out");
        return false;
    }
    else if(pass.length < 6)
    {
    	alert("Password must be Minimum 6 digits");
        return false;
    }
    else if(pass.length > 15)
    {
    	alert("Too much long password must be under 15 charecter");
        return false;
    }
    else if(dob == "")
    {
    	alert("Date of Birth must be filled out");
        return false;
    }
    else if(phone == "")
    {
    	alert("Phone number must be filled out");
        return false;
    }
    else if(phone.length > 30)
    {
    	alert("Invalid Phone number");
        return false;
    }
    else if(city == "")
    {
    	alert("City must be filled out");
        return false;
    }
    else if(city.length > 30)
    {
    	alert("Too much long city name, must be under 30 charecter");
        return false;
    }
    else if(country == "")
    {
    	alert("Country must be filled out");
        return false;
    }
    else if(country.length > 30)
    {
    	alert("Too much long country name must be under 30 charecter");
        return false;
    }
    else if(state == "")
    {
    	alert("State must be filled out");
        return false;
    }
    else if(state.length > 30)
    {
    	alert("Too much long state name, must be under 30 charecter");
        return false;
    }
    else if(postal == "")
    {
    	alert("Postal Code must be filled out");
        return false;
    }
    else if(postal.length > 30)
    {
    	alert("Invalid postal code");
        return false;
    }
}
</script>
	<title>Appnet|Upload Project</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<body>
	<form name="updateForm" action='updateUser.php' onsubmit="return validateUpdateForm()" method='post'>
		<div class="header" style="text-transform: capitalize;">
			<a href="home2.php" style="color:grey; text-decoration:none;"><span style="padding: 30px"> <span style="color: green;">app</span>net</span></a>
			<ul>
				<li><a href="userPanelProjects.php">Projects</a></li>
				<li><a href="userPanelPersonalInfo.php">Account</a></li>
			</ul>
		</div>
		<br> <br>
		<div style="max-width: 590px" class="accountDetails">
			<span class="heading">
						Personal Information
			</span>
			<hr/>
			<table style="padding-right: 400px;">
				<tr>
					<td align="right" style="padding-right: 50px;">First Name</td>
					<td><input placeholder="Put your first name here" style="min-width: 245px;" type="text" name="f_name" value="<?php echo $_SESSION["f_name"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Last Name</td>
					<td><input placeholder="Put your last name here" style="min-width: 245px;" type="text" name="l_name" value="<?php echo $_SESSION["l_name"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Email</td>
					<td><input placeholder="Put your email here" style="min-width: 245px;" type="text" name="email" value="<?php echo $_SESSION["email"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Password</td>
					<td><input placeholder="Put your password here" style="min-width: 245px;" type="password" name="password" value="<?php echo $_SESSION["password"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Date of Birth</td>
					<td><input placeholder="Put your date of birth here" style="min-width: 245px;" type="date" name="dob" value="<?php echo $_SESSION["dob"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Phone</td>
					<td><input placeholder="Put your phone number here" style="min-width: 245px;" type="text" name="phone" value="<?php echo $_SESSION["phone"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Country</td>
					<td>
						<select style="min-width: 245px; min-height: 23px" name="country">
							<option value="Bangladesh" <?php
							$var = $_SESSION['country'];
							if ($var == "Bangladesh") {
								echo "selected";
							}
							?>>
								Bangladesh
							</option>
							<option value="Brazil" <?php
							$var = $_SESSION['country'];
							if ($var == "Brazil") {
								echo "selected";
							}
							?>>
								Brazil
							</option>
							<option value="France" <?php
							$var = $_SESSION['country'];
							if ($var == "France") {
								echo "selected";
							}
							?>>
								France
							</option>
							<option value="United States" <?php
							$var = $_SESSION['country'];
							if ($var == "United States") {
								echo "selected";
							}
							?>>
								United States
							</option>
							<option value="Russia" <?php
							$var = $_SESSION['country'];
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
					<td align="right" style="padding-right: 50px;">City</td>
					<td><input placeholder="Put your city here" style="min-width: 245px;" type="text" name="city" value="<?php echo $_SESSION["city"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">State</td>
					<td><input placeholder="Put your state here" style="min-width: 245px;" type="text" name="state" value="<?php echo $_SESSION["state"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Postal Code</td>
					<td><input placeholder="Put your postal code here" style="min-width: 245px;" type="text" name="postal" value="<?php echo $_SESSION["p_code"]?>"></td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 50px;">Address</td>
					<td><input placeholder="Put your postal code here" style="min-width: 245px;" type="text" name="address" value="<?php echo $_SESSION["address"]?>"></td>
				</tr>
				<tr class="gap" />
				<tr>
					<td align='center' colspan='2' style="color:red;font-weight: bold;text-align: center;">
						
						<?php
							include '../../database/crud_operations.php';
							if(isset($_POST["update_button"]))
							{
								$name="";$email="";$password="";$dob="";
								$phone="";$country="";$city="";$state="";$postal="";

								$f_name = $_POST["f_name"];
								$l_name = $_POST["l_name"];
								$email = $_POST["email"];
								$pass = $_POST["password"];
								$dob = $_POST["dob"];
								$phone = $_POST["phone"];
								$country = $_POST["country"];
								$city = $_POST["city"];
								$state = $_POST["state"];
								$postal = $_POST["postal"];
								$flag = true;

								if($f_name == "")
								{
									echo "First Name must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[a-zA-Z ]*$/",$f_name))
								{
									echo "invalid first name";
									$flag = false;
								}
								else if($l_name == "")
								{
									echo "Last Name must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[a-zA-Z ]*$/",$l_name))
								{
									echo "invalid last name";
									$flag = false;
								}
								else if($email == "")
								{
									echo "Email must be filled out";
									$flag = false;
								}
								elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
								{
									echo "Invalid email format";
									$flag = false;
								}
								else if($pass == "")
								{
									echo "Password must be filled out";
									$flag = false;
								}
								elseif(strlen($pass)<6)
								{
									echo "Password must contaion atlist 6 charecter";
									$flag = false;
								}
								else if($dob == "")
								{
									echo "Date of Birth must be filled out";
									$flag = false;
								}
								else if($phone == "")
								{
									echo "Phone number must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[0-9+]*$/",$phone))
								{
									echo "invalid phone number";
									$flag = false;
								}
								else if($city == "")
								{
									echo "City must be filled out";
									$flag = false;
								}
								else if($country == "")
								{
									echo "Country must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[a-zA-Z ]*$/",$city))
								{
									echo "invalid City name";
									$flag = false;
								}
								else if($state == "")
								{
									echo "State must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[a-zA-Z ]*$/",$state))
								{
									echo "invalid State name";
									$flag = false;
								}
								else if($postal == "")
								{
									echo "Postal Code must be filled out";
									$flag = false;
								}
								else if(!preg_match("/^[0-9+]*$/",$postal))
								{
									echo "invalid postal code";
									$flag = false;
								}

								if($flag)
								{
									$update_tag = update_user_data($_POST["f_name"],$_POST["l_name"],$_POST["dob"],$_POST["phone"],$_POST["email"],$_POST["password"],$_POST["country"],$_POST["city"],$_POST["state"],$_POST["postal"],$_POST["address"],$_SESSION["user_id"]);
									if($update_tag)
									{
										$_SESSION["f_name"] = $_POST["f_name"];
										$_SESSION["l_name"] = $_POST["l_name"];
										$_SESSION["dob"] = $_POST["dob"];
										$_SESSION["phone"] = $_POST["phone"];
										$_SESSION["email"] = $_POST["email"];
										$_SESSION["country"] = $_POST["country"];
										$_SESSION["city"] = $_POST["city"];
										$_SESSION["state"] = $_POST["state"];
										$_SESSION["address"] = $_POST["address"];
										$_SESSION["p_code"] = $_POST["postal"];
										$_SESSION["password"] = $_POST["password"];
										$message = "Update successfully";
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
								}
							}
							elseif (isset($_POST['discard_changes'])) 
							{
								//header("Location:userPanelPersonalInfo.php");
							}
						?>
					</td>
				</tr>
				<tr>
					<td style="padding-right: 15px;" colspan="2" align="right">
						<input type="submit" name="update_button" value="Update">
						<br><br>
						<label style="color: red;"><b>
						</label></b>
					</td>
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
						<td><a href="">Contact Support</a></td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</body>
</html>
