<?php
	$con = mysqli_connect("localhost","root","","appnet");
	if(isset($_REQUEST["q"]))
	{
		$phone = $_REQUEST["q"];
		$sql = "select user_id from user where phone = '". $phone ."'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			echo "Not Available ✘";
		}
	}
	if(isset($_REQUEST["r"]))
	{
		$email = $_REQUEST["r"];
		$sql2 = "select user_id from user where email = '". $email ."'";
		$res2=mysqli_query($con,$sql2);
		if(mysqli_num_rows($res2)>0)
		{
			echo "Not Available ✘";
		}
	}

?>
