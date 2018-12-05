<?php
	session_start();
	session_destroy();
	setcookie("nimda", false, time() - 3600, "/");
	header("Location:../front/Home.php");
?>
