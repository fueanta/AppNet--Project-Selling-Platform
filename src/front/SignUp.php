<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<script>
	function getPhone(str)
	{
		if(str.length==0)
		{
			document.getElementById("phone").innerHTML="";
		}
		else
		{
			var xHttp = new XMLHttpRequest();
			xHttp.onreadystatechange=function()
			{
				if(this.readyState==4 && this.status==200)
				{
					document.getElementById("phone").innerHTML=this.responseText;
				}
			};
			xHttp.open("GET","ajax.php?q="+str,true);
			xHttp.send();
		}
	}
	function getEmail(str)
	{
		if(str.length==0)
		{
			document.getElementById("email").innerHTML="";
		}
		else
		{
			var xHttp = new XMLHttpRequest();
			xHttp.onreadystatechange=function()
			{
				if(this.readyState==4 && this.status==200)
				{
					document.getElementById("email").innerHTML=this.responseText;
				}
			};
			xHttp.open("GET","ajax.php?r="+str,true);
			xHttp.send();
		}
	}
</script>

    <meta charset="UTF-8">
    <title>Appnet | SignUp</title>
    <link rel="stylesheet" href="../../css/SignUpStyle.css">
</head>
<body>
	<form action='SignUp.php' method='post'>
	
		<div class="header">
			<div class="logo">
				<label class="logoP1">app</label>
				<label class="logoP2">net</label>
			</div>
			<div class="signUpBox">
				<label class="topLabel">Create Your Account</label><br/>
				<div style="margin-left: 10px;">
					<input type="text" placeholder="First Name" class="inputs" name="first_name" required><br/>
					<input type="text" placeholder="Last Name" class="inputs" name="last_name" required><br/>
					<input placeholder="Date of Birth" class="inputs" type="text" onfocus="(this.type='date')"
						   onblur="(this.type='text')"  id="date" name="dob" required><br/>
					<input onkeyup="getPhone(this.value)" type="text" placeholder="Phone Number" class="inputs" name="phone" required> <l style="color:red;" id="phone"> </l> <br/>
					<input onkeyup="getEmail(this.value)" type="email" placeholder="Email Address" class="inputs" name="email" required> <l style="color:red;" id="email"> </l> <br/>
					<input type="password" placeholder="Pasword (minimum 8 characters)" class="inputs" name="pass1" required><br/>
					<input type="password" placeholder="Re-type Password" class="inputs" name="pass2" required><br/>
					<br>
					<input type="submit" value="Sign Up" class="inputButton" name="valueSubmit">
					<br> <br>

					<label style="color: red; display: inline-block; margin-left: 130px;"><b>
					<?php
						include '../../database/fetch_data.php';
						if (isset($_POST["valueSubmit"]))
						{
							$value = validate($_POST["first_name"], $_POST["last_name"], $_POST["dob"], $_POST["phone"], $_POST["email"], $_POST["pass1"], $_POST["pass2"]);

							if ($value)
							{
								if ($exists = fetch_user_by_phone_email($_POST["phone"], $_POST["email"]))
								{
									echo "User already exists!";
								}
								else
								{
									header("Location:SignUpP2.php");
								}
							}
						}

						function validateName($name)
						{
							$start = ord(substr($name,0,1));
							if ($name=="")
							{
								echo "Any of the names can not be empty";
								return false;
							}
							elseif (!preg_match("/^[a-zA-Z .,-]*$/",$name))
							{
								echo "Only letters and white spaces are allowed in names";
								return false;
							}
							else 
							{
								return true;
							}
						}

						function validateDate($date)
						{
							if ($date=="")
							{
								echo "Date of Birth can not be empty";
								return false;
							}
							else
							{
								return true;
							}
						}

						function validatePhone($phone)
						{
							// code
							if ($phone=="")
							{
								echo "Phone no. can not be empty";
								return false;
							}
							else 
							{
								return true;
							}
						}

						function validateEmail($email)
						{
							if ($email=="")
							{
								echo "Email can not be empty";
								return false;
							}
							elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
							{
								echo "Invalid email format";
								return false;
							}
							else 
							{
								return true;
							}
						}

						function validatePassword($password1, $password2)
						{
							$pass1 = $password1;
							$pass2 = $password2;
							if($pass1 != $pass2)
							{
								echo "Password cannot be empty";
								return false;
							}
							elseif(strlen($pass1)<8)
							{
								echo "Password must contain minimum 8 characters";
								return false;
							}
							elseif(strlen($pass1)>30)
							{
								echo "Password cannot contain more than 30 characters";
								return false;
							}
							elseif($pass1 == "")
							{
								echo "Passwords didn't match";
								return false;
							}							
							else
							{
								return true;
							}
						}

						function validate($fn, $ln, $dob, $phone, $email, $pass1, $pass2)
						{
							$validated = false;
							$validated = validateName($fn);
							if (!$validated) { return $validated; }
							$validated = validateName($ln);
							if (!$validated) { return $validated; }
							$validated = validateDate($dob);
							if (!$validated) { return $validated; }
							$validated = validatePhone($phone);
							if (!$validated) { return $validated; }
							$validated = validateEmail($email);
							if (!$validated) { return $validated; }
							$validated = validatePassword($pass1, $pass2);

							if ($validated)
							{
								$_SESSION["fn"] = $fn;
								$_SESSION["ln"] = $ln;
								$_SESSION["dob"] = $dob;
								$_SESSION["phone"] = $phone;
								$_SESSION["email"] = $email;
								$_SESSION["pass"] = $pass1;

								$_SESSION['signup_p2_access'] = true;
							}

							return $validated;
						}

					?>
				</b></label>

				</div>
			</div>
		</div>
	</form>
</body>
</html>