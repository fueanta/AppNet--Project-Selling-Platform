
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|ForgotPassword</title>
	<link rel="stylesheet" href="../../css/forgotPasswordStyle.css">
</head>
<body>
	<header>
		<div class="logo">
			<span class="logoGreen">app</span>net
		</div>
	</header>
	<section class="card">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input type="text" name="email" placeholder="Enter your email here" id="emailText"><br>
			<input type="submit" name="submit" value="reset password" id="submit">
		</form>
		<span class="heading">
			<br>
			<br>
			<?php

			 	include_once '../../database/fetch_data.php';
			 	include_once '../../database/crud_operations.php';

				if(isset($_POST["submit"]))
				{
					$mail=$_POST["email"];
					$flag=0;
					$table=get_email($mail);
					if(empty($mail))
					{
						$flag=1;
					}
					elseif ($table->num_rows==0) {
						$flag=1;
					}
					if($flag==1)
					{
						echo "<b>Please enter a valid email assosiated with this website.</b>";
					}
					else{
						update_forgot_email($mail);
					}
				}
	 		?>
		</span>

	</section>
</body>
</html>
