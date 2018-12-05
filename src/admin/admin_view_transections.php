<!DOCTYPE html>
<html>
<head>
	<title>Appnet | Admin</title>
	<link rel="stylesheet" type="text/css" href="../../css/AdminDashboardStyle.css">
</head>
<body>
	<div align='center'>
		<span class="heading">
					Transaction History
		</span>		
		<hr/>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<table max-width: 300px;>
			<tr>
				<td>
					From Date
				</td>
				<td align="left">
					<input style="min-width: 150px;" type="date" name="fromDate">
				</td>
			</tr>
			<tr>
				<td>
					To Date
				</td>
				<td align="left">
					<input style="min-width: 150px;" type="date" name="toDate">
				</td>
			</tr>
			<tr>
				<td>
					Specify Project
				</td>
				<td align="left">
					<input placeholder="Project Id, Name, Price.." style="min-width: 150px; min-height: 18px;" type="text" name="identity" value="">
				</td>
			</tr>
			<tr>
				<td align="left"><input type="submit" name="search" value="Show History"></td>
                <td align="left"><input type="submit" name="all_history" value="All History"></td>
			</tr>
			<tr class="gap" />
		</table>
		<br> <br>
		<table align="center" style="border-collapse: collapse; min-width: 1000px;" border="1" class="viewTransactions">
			

			<?php 
			include_once '../../database/fetch_data.php';

			if(isset($_POST["all_history"]))
			{
				$table=fetch_all_transaction();

				echo 
                    "<tr>
						<th>Project Name</th>
						<th>Project Buyer</th>
						<th>Project Seller</th>
						<th>Date & Time</th>
						<th>Price</th>
					</tr>";

				while ($row=mysqli_fetch_array($table)) {
					echo "

					<tr>
						<td align='center'>". $row['project_name'] . "</td>
						<td align='center'>" .$row['buyer_f_name'] ." ".$row['buyer_l_name'] . "</td>
						<td align='center'>" .$row['seller_f_name'] ." ".$row['seller_l_name'] . "</td>
						<td align='center'>" . $row['transaction_time'] . "</td>
						<td align='center'>" . $row['selling_price'] . "</td>
					";
					
				}
			}
			else if(isset($_POST["search"]))
			{
				if(!empty($_POST["fromDate"]))
                {
                    $fromDate=$_POST["fromDate"];
                }
                if(!empty($_POST["toDate"]))
                {
                    $toDate=$_POST["toDate"];
                }
                if(!empty($_POST["identity"]))
                {
                    $identity=$_POST["identity"];
                }
                if(isset($fromDate) && isset($toDate) && isset($identity))
                {
                	$table=fetch_transaction_by_date_and_identity($fromDate, $toDate, $identity);

					echo 
	                    "<tr>
							<th>Project Name</th>
							<th>Project Buyer</th>
							<th>Project Seller</th>
							<th>Date & Time</th>
							<th>Price</th>
						</tr>";

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>". $row['project_name'] . "</td>
							<td align='center'>" .$row['buyer_f_name'] ." ".$row['buyer_l_name'] . "</td>
							<td align='center'>" .$row['seller_f_name'] ." ".$row['seller_l_name'] . "</td>
							<td align='center'>" . $row['transaction_time'] . "</td>
							<td align='center'>" . $row['selling_price'] . "</td>
						";
						
					}
                }
                else if(isset($fromDate) && isset($toDate))
                {
                	$table=fetch_transaction_by_identity($identity);

					echo 
	                    "<tr>
							<th>Project Name</th>
							<th>Project Buyer</th>
							<th>Project Seller</th>
							<th>Date & Time</th>
							<th>Price</th>
						</tr>";

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>". $row['project_name'] . "</td>
							<td align='center'>" .$row['buyer_f_name'] ." ".$row['buyer_l_name'] . "</td>
							<td align='center'>" .$row['seller_f_name'] ." ".$row['seller_l_name'] . "</td>
							<td align='center'>" . $row['transaction_time'] . "</td>
							<td align='center'>" . $row['selling_price'] . "</td>
						";
						
					}
                }
                else if(isset($identity))
                {
                	$table=fetch_transaction_by_identity($identity);

					echo 
	                    "<tr>
							<th>Project Name</th>
							<th>Project Buyer</th>
							<th>Project Seller</th>
							<th>Date & Time</th>
							<th>Price</th>
						</tr>";

					while ($row=mysqli_fetch_array($table)) {
						echo "

						<tr>
							<td align='center'>". $row['project_name'] . "</td>
							<td align='center'>" .$row['buyer_f_name'] ." ".$row['buyer_l_name'] . "</td>
							<td align='center'>" .$row['seller_f_name'] ." ".$row['seller_l_name'] . "</td>
							<td align='center'>" . $row['transaction_time'] . "</td>
							<td align='center'>" . $row['selling_price'] . "</td>
						";
						
					}
                }
			}
			

		 	?>	
			<tr class="gap" />
		</table>
		<table align="center" style="min-width: 1000px; border-collapse: collapse;">
			<?php 
			include_once '../../database/fetch_data.php';
			$totalPrice=0;
			$total = 0;
			if(isset($_POST["all_history"]))
            {
                $table=fetch_all_transaction();
            }
            else if(isset($fromDate) && isset($toDate) && isset($identity))
            {
                $table=fetch_transaction_by_date_and_identity($fromDate,$toDate,$identity);
            }
            else if(isset($fromDate) && isset($toDate))
            {
                $table=fetch_transaction_by_date($fromDate,$toDate);
            }
            else if(isset($identity))
            {
                $table=fetch_transaction_by_identity($_POST["identity"]);
            }
            if(isset($table))
            {
            	while ($row=mysqli_fetch_array($table)) {
					
					$totalPrice+=$row['selling_price'];
				}
                echo "
            
                <tr>
					<td align='right'>
					<b><u>Total: </u></b> <b>".$totalPrice."</b> 
					</td>
				</tr>
                ";
            }
			 ?>
			<tr class="gap" />
		</table>
		</form>
	</div>
</body>
</html>