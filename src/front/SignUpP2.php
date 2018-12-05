<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appnet | Signup</title>
    <link rel="stylesheet" href="../../css/SignUpStyleP2.css">
</head>
<body>
	<form action='SignUpP2.php' method='post'>
		<div class="header">
			<div class="logo">
				<label class="logoP1">app</label>
				<label class="logoP2">net</label>
			</div>
			<div class="signUpBox">
				<label class="topLabel">Almost done!!!</label><br/>

				<div style="padding-left: 50px;">
					<table style="border-collapse: separate;" style="padding: 20px; border-spacing: 0 15px;">
					<tr>
						<td align="right">
							<label class="countryInput">Country:</label>
						</td>
						<td align="center">
							<select class="countryInputValues" name="country" style="min-width: 200px;">
								<option disabled selected>Select Country</option>
								<option>United States</option>
								<option>United Kingdom</option>
								<option>Canada</option>
								<option>India</option>
								<option>Bangladesh</option>
								<option>Japan</option>
								<option>South Korea</option>
								<option>France</option>
								<option>Russia</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label class="areaLabel">City:</label>
						</td>
						<td>
							<input style="margin-left: 20px; min-width: 200px;" type="text" class="textInput" name="city" required>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label class="areaLabel">State / District:</label>
						</td>
						<td>
							<input style="margin-left: 20px; min-width: 200px;" type="text" class="textInput" name="state">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label class="areaLabel">Postal Code:</label>
						</td>
						<td>
							<input style="margin-left: 20px; min-width: 200px;" type="text" class="textInput" name="postalcode" required>
						</td>
					</tr>
				</table>
				<br>
				<label class="addressDetails">Address:</label><br/>
				<textarea rows="5" cols="10" class="fullAddressInput" name="address" required></textarea><br/>
				</div>

				<div>
					<br>
					<input type="submit" value="Complete Sign Up" class="inputButton" name="inputButton">
				</div>

				<br> <br>
				<label style="color: red; display: inline-block; margin-left: 130px;"><b>
					<?php
						include '../../database/crud_operations.php';

						if (isset($_POST["inputButton"]))
						{
							$_SESSION['signup_p2_access'] = true;
							if (isset($_POST["country"]))
							{
								$value = validate($_POST["country"], $_POST["city"], $_POST["state"], $_POST["postalcode"], $_POST["address"]);
								if ($value)
								{
									echo insert_user_data($_SESSION['fn'], $_SESSION['ln'], $_SESSION['dob'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['pass'], $_POST["country"], $_POST["city"], $_POST["state"], $_POST["postalcode"], $_POST["address"]);
									session_destroy();
									header("Location:Login.php");
								}
							}
							else echo "You must select a country";
						}
						//else echo "Page was not submitted properly";

						// if no access then jump to sign up 1 page
						if (!$_SESSION['signup_p2_access'])
						{
							header("Location:signup.php");
						}
						// removing access to sign up page2 every time it refreses
						$_SESSION['signup_p2_access'] = false;

						function validateCountry($country)
						{
							if ($country=="" || $country==null) {
								# code...
							}
							elseif ($country=="Select Country")
							{
								echo "You must select a country";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validateCity($city)
						{
							if ($city=="")
							{
								echo "You must specify a city";
								return false;
							}
							elseif (!preg_match("/^[a-zA-Z ]*$/",$city))
							{
								echo "Only letters and white spaces are allowed in City Name";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validateState($state)
						{
							if ($state=="")
							{
								echo "You must specify a state";
								return false;
							}
							elseif (!preg_match("/^[a-zA-Z ]*$/",$state))
							{
								echo "Only letters and white spaces are allowed in State Name";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validatePostalCode($pcode)
						{
							if ($pcode=="")
							{
								echo "Postal-code can not be empty";
								return false;
							}
							elseif (!preg_match("/^[0-9]*$/",$pcode))
							{
								echo "Postal-code should only contain numaric digits";
								return false;
							}
							elseif(strlen($_POST["postalcode"])>5)
							{
								echo "Postal-code cannot contain more than 5 digits";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validateAddress($addr)
						{
							if($addr=="")
							{
								echo "Address can not be empty";
								return false;
							}
							elseif (strlen($addr)>500)
							{
								echo "Address cannot contain more then 500 letters";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validate($country, $city, $state, $pcode, $addr)
						{
							$validated = false;
							$validated = validateCountry($country);
							if (!$validated) { return $validated; }
							$validated = validateCity($city);
							if (!$validated) { return $validated; }
							$validated = validateState($state);
							if (!$validated) { return $validated; }
							$validated = validatePostalCode($pcode);
							if (!$validated) { return $validated; }
							$validated = validateAddress($addr);
							return $validated;
						}

					?>
				</b></label>
			</div>
		</div>
	</form>
</body>
</html>
