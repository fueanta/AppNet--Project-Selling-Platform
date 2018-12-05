<?php
  session_start();
  if(!isset($_SESSION["admin"]))
  {
    header("Location:../front/home.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appnet | Admin</title>
    <link rel="stylesheet" type="text/css" href="../../css/AdminDashboardStyle.css">
</head>
<body>
    <form action="../user/logout.php">
    <div class="logoBar">
        <div class="logo">
            <label><span style="color: green;"> <a href="../front/home.php" style="text-decoration:none;"> Appnet</a></span></label>
            <label>             
                <?php
					echo str_repeat('&nbsp;',80)."<b style='color:green;'>Admin Panel</b>";
				?>
            </label>

        </div>
    </div>
    <div class="sideMenu">
        <ul>
            <li><a href="admin_view_user.php" target="adminIframe">User</a></li>
            <li><a href="admin_view_project.php" target="adminIframe">Project</a></li>
            <li><a href="admin_view_transections.php" target="adminIframe">Transaction</a></li>
            <li><a href="admin_view_transfers.php" target="adminIframe">Transfer</a></li>
            <li><a href="changeAdminPass.php" target="adminIframe">Change Password</a></li>
            <li><input type='submit' name='logout_action', value= 'logout'></li>
        </ul>
    </div>

	<div class="viewPort" >
		<iframe name="adminIframe" frameborder="0" src="admin_view_user.php" height="800" width="1000"></iframe>
	</div>
    </form>
</body>
</html>