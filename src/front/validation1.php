<?php

	if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["dob"]) && isset($_POST["email"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]))
	{
		$value = validate($_POST["first_name"], $_POST["last_name"], $_POST["dob"], $_POST["email"], $_POST["pass1"], $_POST["pass2"]);

		if ($value)
		{
			header("Location:SignUpP2.php");
		}
	}

	function validateName($name)
	{
		$start = ord(substr($name,0,1));
		if ($name=="")
		{
			echo "<br>";
			echo " Name can not be empty";
			return false;
		}
		elseif(!(($start>64 && $start<91) ||($start>96 && $start<123)))
		{
			echo "<br>";
			echo "Name can not start with letter";
			return false;
		}
		elseif (!preg_match("/^[a-zA-Z .,-]*$/",$name))
		{
			echo "<br>";
			echo "Only letters and white space allowed in Name";
			return false;
		}
		else 
		{
			echo "<br>";
			echo $name;
			return true;
		}
	}

	function validateDate($date)
	{
		if ($date=="")
		{
			echo "<br>";
			echo "Date of Birth can not be empty";
			return false;
		}
		else
		{
			echo "<br>";
			echo $date;
			return true;
		}
	}

	function validateEmail($email)
	{
		if ($email=="")
		{
			echo "<br>";
			echo "Email can not be empty";
			return false;
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo "<br>";
			echo "Invalid email format";
			return false;
		}
		else 
		{
			echo "<br>";
			echo $email;
			return true;
		}
	}

	function validatePassword($password1, $password2)
	{
		$pass1 = $password1;
		$pass2 = $password2;
		if($pass1 != $pass2)
		{
			echo "<br>";
			echo "Miss match password";
			return false;
		}
		elseif($pass1 == "")
		{
			echo "<br>";
			echo "Password cant be empty";
			return false;
		}
		elseif(strlen($pass1)<6)
		{
			echo "<br>";
			echo "Password must contain minimum 6 digit";
			return false;
		}
		elseif(strlen($pass1)>15)
		{
			echo "<br>";
			echo "Password cant contain more then 15 digit";
			return false;
		}
		else
		{
			echo "<br>";
			echo $pass1;
			return true;
		}
	}

	function validate($fn, $ln, $dob, $email, $pass1, $pass2)
	{
		$validated = false;
		$validated = validateName($fn);
		if (!$validated) { return $validated; }
		$validated = validateName($ln);
		if (!$validated) { return $validated; }
		$validated = validateDate($dob);
		if (!$validated) { return $validated; }
		$validated = validateEmail($email);
		if (!$validated) { return $validated; }
		$validated = validatePassword($pass1, $pass2);
		return $validated;
	}

?>