<!DOCTYPE html>
<html>
<head>
<style>
.btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 20px 20px;
    font-size: 16px;
    cursor: pointer;
}
.btn2 {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 10px 10px;
    font-size: 10px;
    cursor: pointer;
}
.btn3 {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
}
/* Darker background on mouse-over */
.btn:hover {
    background-color: RoyalBlue;
}
.btn2 {background-color: #f44336;}
.btn3 {background-color: #4CAF50;}
.btn3 {border-radius: 12px;}
</style>
	<title>Appnet|User</title>
	<link rel="stylesheet" type="text/css" href="AdminDashboardStyle.css">
</head>
<body>
	<div class="logoBar">
		<div class="logo">
			<label><span style="color: green;"> <a href="home.html" style="text-decoration:none;"> Appnet</a></span></label>
			<label> 			
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp			 
			Admin Panel
			</label>
		</div>
	</div>
	<div class="sideMenu">
		<ul>
			<li><a href="admin_view_user.html">User</a></li>
			<li><a href="admin_view_project.html">Project</a></li>
			<li><a href="admin_view_transections.html">Transaction</a></li>
			<li><a href="#">Transfer</a></li>
			<li><a href="admin_view_page_content.html">Page Contents</a></li>
			<li><a href="#">Catagory Platform Tags</a></li>
		</ul>
	</div>
	<p align="right">
		<input type="text" name="search" placeholder="search...">
		<input type="submit" name="searchSubmit" value="Submit" class="searchButton">
	</p>
	<br>
	<center> <h2> Manage Page Contents </h2> </center>
	<h3> Home | Android | IOS | Linux | Others </h3>
	<br>
	<hr>
	<table>
		<tr>			
			<td>
			<button class="btn"><i class="fa fa-close"></i> Home</button>
			<button class="btn2"><i class="fa fa-close"></i>X</button>
			</td>
			<td>
			<button class="btn"><i class="fa fa-close"></i> Android</button>
			<button class="btn2"><i class="fa fa-close"></i>X</button>
			</td>
			<td>
			<button class="btn"><i class="fa fa-close"></i> IOS</button>
			<button class="btn2"><i class="fa fa-close"></i>X</button>
			</td>
			<td>
			<button class="btn"><i class="fa fa-close"></i> Linux</button>
			<button class="btn2"><i class="fa fa-close"></i>X</button>
			</td>
			<td>
			<button class="btn"><i class="fa fa-close"></i> Others</button>
			<button class="btn2"><i class="fa fa-close"></i>X</button>
			</td>			
		</tr>
	</table>
	<br><br><br><br><br>
	<p align="center">
		<button class="btn3"><i class="fa fa-close"></i> Upload</button>
		<button class="btn3"><i class="fa fa-close"></i> Select</button>
	</p>
</body>
</html>