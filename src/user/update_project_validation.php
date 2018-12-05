<?php
	$flag = true;
	if(isset($_POST["price"]))
	{
		if(!preg_match("/^[0-9]*$/",$_POST["price"]))
		{
			echo "Invalid price";
			$flag = false;
		}
	}
	else if(isset($_POST["discount"]))
	{
		if(!preg_match("/^[0-9]*$/",$_POST["price"]))
		{
			echo "Invalid discount";
			$flag = false;
		}
	}
	else if(isset($_POST["icon"]))
	{
		$info = pathinfo($_POST["icon"]);
		$size = filesize($info['dirname']);
		if($size == 0)
		{
			echo "Must select an icon file";
			$flag = false;
		}
		else if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed in icon";
			$flag = false;
		}
	}
	else if(isset($_POST["s1"]))
	{
		$info = pathinfo($_POST["s1"]);
		if($info =="")
		{
			echo "Must select at list one screen short";
			$flag = false;
		}
		else if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed";
			$flag = false;
		}
	}
	else if(isset($_POST["s2"]))
	{
		$info = pathinfo($_POST["s2"]);
		if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed";
			$flag = false;
		}
	}
	else if(isset($_POST["s3"]))
	{
		$info = pathinfo($_POST["s3"]);
		if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed";
			$flag = false;
		}
	}
	else if(isset($_POST["s4"]))
	{
		$info = pathinfo($_POST["s4"]);
		if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed";
			$flag = false;
		}
	}
	else if(isset($_POST["s5"]))
	{
		$info = pathinfo($_POST["s5"]);
		if (!($info["extension"] == "jpg" || $info["extension"] == "jpeg" || $info["extension"] == "png"))
		{
			echo "Only jpg,jpeg,png files are allowed";
			$flag = false;
		}
	}

	if($flag)
	{
		echo "All ok";
	}
?>