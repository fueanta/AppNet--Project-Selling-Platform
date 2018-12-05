<?php
	$user = $_POST["user"];
	$password = $_POST["pass"];

	//connection with database

	$con = mysqli_connect("localhost","root","","appnet");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "select * from user where email = '$user' and password = '$password'";
	$result=mysqli_query($con,$sql);

	$row=mysqli_fetch_array($result,MYSQLI_NUM);

	if($row[5] == $user && $row[13] == $password)
	{
		header("Location:Home2.html");
	}
	else if($user = "admin" && $password = "admin")
	{
		header("Location:Home3.html");
	}
	else
	{
		echo "<br>";
		echo "Invalid login request";
	}

?>