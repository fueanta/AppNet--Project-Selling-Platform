<?php
	session_start();
	include_once '../../database/crud_operations.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Userpanel</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<body>
	<br> <br>
	<div style="max-width: 600px" class="accountDetails">
		<span class="heading">
					Change Admin Password
		</span>
		<hr/>
		<form class="" action="changeAdminPass.php" method="post">
      <table style="padding-right: 600px;">
          <tr>
              <td align="right">Current Password</td>
              <td><input placeholder="" style="min-width: 240px;" type="text" name="cp" value=""></td>
          </tr>
          <tr>
              <td align="right">New Password</td>
              <td><input placeholder="" style="min-width: 240px;" type="text" name="np" value=""></td>
          </tr>
          <tr>
              <td align="right">Re-enter Password</td>
              <td><input placeholder="" style="min-width: 240px;" type="text" name="np2" value=""></td>
          </tr>
				<tr>
					<tr>
						<td style="padding-right: 0px;" colspan="2" align="right">
							<input type="submit" name="change" value="change">
						</td>
					</tr>
				</tr>
				<tr class="gap" />
			</table>
		</form>
	</div>

</body>
</html>
<?php
	include_once '../../database/crud_operations.php';
	if(isset($_POST['cp']) && isset($_POST['np']) && isset($_POST['np2']))
	{
		if($_SESSION["admin_pass"] != $_POST['cp'])
		{
			echo '<script language="javascript">';
			echo 'alert("Missmatch old password")';
			echo '</script>';
		}
		else if($_POST['np']== "")
		{
			echo '<script language="javascript">';
			echo 'alert("Invalid old password")';
			echo '</script>';
		}
		else if($_POST['np'] != $_POST['np2'])
		{
			echo '<script language="javascript">';
			echo 'alert("Missmatch new password")';
			echo '</script>';
		}
		else
		{
			change_admin_pass($_POST['np']);
			echo '<script language="javascript">';
			echo 'alert("Password updated")';
			echo '</script>';
		}
	}
?>
