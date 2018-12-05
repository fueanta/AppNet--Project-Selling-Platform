<?php

	if (isset($_POST["country"]) && isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["postalcode"]) && isset($_POST["address"]))
	{
		$value = validate($_POST["country"], $_POST["city"], $_POST["state"], $_POST["postalcode"], $_POST["address"]);

		if ($value)
		{
			header("Location:Login.php");
		}
	}

	function validateCountry($country)
	{
		if ($country=="Select Country")
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
			echo "Postal-code only contains numaric digits";
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