<!DOCTYPE html>
<html>
<head>
	<title>Appnet|Userpanel</title>
	<link rel="stylesheet" type="text/css" href="../../css/userPanelStyle.css">
</head>
<body>
	<div class="header" style="text-transform: capitalize;">
		<span style="padding: 30px"> <span style="color: green;">app</span>net</span>
		<ul>
			<li><a href="userPanelProjects.html">Projects</a></li>
			<li><a href="userPanelPersonalInfo.html">Account</a></li>
		</ul>
	</div>
	<div class="nav">
		<div class="categories">
			<a href="../front/home.php">Home</a>
			<a href="../front/Windows.php">Windows</a>
			<a href="../front/IOS.php">IOS</a>
			<a href="../front/Android.php">Android</a>
			<a href="../front/Linux.php">Linux</a> 
			<input type="submit" name="searchSubmit" value="Submit" class="searchButton">
			<input type="text" name="search" placeholder="search...">
		</div>
	</div>
	<br> <br>
	<div style="max-width: 475px" class="accountDetails">
		<span class="heading">
					Personal Information
		</span>
		<hr/>
		<table style="padding-right: 400px;">
			<tr>
				<td align="right" style="padding-right: 50px;">Name</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Email</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Password</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Date of Birth</td>
				<td><input style="min-width: 145px;" type="date" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Phone</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Country</td>
				<td>
					<select style="min-width: 144px; min-height: 21px;">
  						<option value="Bangladesh">Bangladesh</option>
  						<option value="Brazil">Brazil</option>
  						<option value="France">France</option>
  						<option value="Croatia">Croatia</option>
  						<option value="India">India</option>
  						<option value="United States">United States</option>
  						<option value="Russia">Russia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">City</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">State</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 50px;">Postal Code</td>
				<td><input type="text" name=""></td>
			</tr>
			<tr class="gap" />

			<tr>
				<td colspan="2" align="center">
					<input type="button" name="" value="Update">
				</td>
			</tr>
			<tr class="gap" />
		</table>
	</div>
</body>
</html>
