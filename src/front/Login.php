<?php
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

<script>
function validateForm()
{
    var user = document.forms["loginForm"]["user"].value;
    var pass = document.forms["loginForm"]["pass"].value;
    if (user == "")
    {
        alert("Phone or Email must be provided");
        return false;
    }
    else if(pass == "")
    {
    	alert("Password has not been provided");
        return false;
    }
}
function validateServer()
{
	alert("Username or Email must be filled out");
}
</script>

    <meta charset="UTF-8">
    <title>Appnet | Login</title>
    <link rel="stylesheet" href="../../css/LoginStyle.css">
</head>
<body>
	<form name="loginForm" action='login.php' onsubmit="return validateForm()" method='post'>
		<div class="header">
				<div class="logo">
					<a href="Home.php" style="color:grey;text-decoration:none;">
						<label class="logoP1">app</label>
						<label class="logoP2">net</label>
					</a>
				</div>
		</div>
		<div class="loginInfoBody">
			<h1 class="topHeader">Log in to start downloading your resources</h1>
			<input type="text" placeholder="Phone or E-mail" class="userNameInput" name="user" required><br/>
			<input type="password" placeholder="Password" class="passwordInput" name="pass" required><br/>
			<input type="submit" value="Log In" class="loginButton" name="login_button"><br/>
			<a href="forgotPassword.php" class="forgotPassword">Forgot Password?</a>
			<label>New to Appnet?</label><br/>
			<a href="signup.php"><input type="button" value="Sign Up Now" class="signUpButton"></a>
			<label style="color: red;"><b>
				<?php
					//$user = fetch_user_on_login($_POST["user"], $_POST["pass"]);
					include '../../database/fetch_data.php';

					if (isset($_POST["login_button"]))
					{
						if($_POST["user"]=="admin")
						{
							$row=fetch_admin();
							$pass = $row['password'];
							if ($_POST["pass"]==$pass)
							{
								$cookie_name = "nimda";
								$cookie_value = $pass;
								setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
								
								$_SESSION["admin"] = true;
								$_SESSION["admin_pass"] = $pass;
								header("Location:home.php");
							}
							else
							{
								echo "<br>";
								echo "Mismatched Credentials!";
							}
						}
						else
						{
							$validated = validate($_POST["user"], $_POST["pass"]);
							if ($validated)
							{
								$user_data = fetch_user_on_login($_POST["user"], $_POST["pass"]);
								if ($user_data)
								{
									$_SESSION["user_id"] = $user_data["user_id"];
									$_SESSION["f_name"] = $user_data["f_name"];
									$_SESSION["l_name"] = $user_data["l_name"];
									$_SESSION["dob"] = $user_data["dob"];
									$_SESSION["phone"] = $user_data["phone"];
									$_SESSION["email"] = $user_data["email"];
									$_SESSION["country"] = $user_data["country"];
									$_SESSION["city"] = $user_data["city"];
									$_SESSION["state"] = $user_data["state"];
									$_SESSION["address"] = $user_data["address"];
									$_SESSION["p_code"] = $user_data["p_code"];
									$_SESSION["balance"] = $user_data["balance"];
									$_SESSION["password"] = $user_data["password"];
									$_SESSION["time_added"] = $user_data["time_added"];
									header("Location:home.php");
								}
								else
								{
									echo "<br>";
									echo "Mismatched Credentials!";
								}
							}
							else
							{
								echo "<br>";
								echo "Invalid Credentials!";
							}
						}

					}

					function validate($phone_or_email, $password)
					{
						if ($phone_or_email == "")
						{
							return false;
						}
						if (strlen($password)<4)
						{
							return false;
						}
						elseif (strlen($password)>30)
						{
							return false;
						}
						elseif ($password == "")
						{
							return false;
						}
						return true;
					}

				 ?>
			</b></label>
		</div>
	</form>

</body>
</html>
