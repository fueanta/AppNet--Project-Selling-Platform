<!DOCTYPE html>
<html>
<head>
	<title>Appnet | Admin</title>
	<link rel="stylesheet" type="text/css" href="../../css/AdminDashboardStyle.css">
</head>
<body>

	<div align='center'>
		<span class="heading">
					Transfer History
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
					Specify User
				</td>
				<td align="left">
					<input placeholder="User Id, Name, Email.." style="min-width: 150px; min-height: 18px;" type="text" name="identity" value="">
				</td>
			</tr>
			
			<tr>
				<td align="left"><input type="submit" name="search" value="Search History"></td>
				<td align="left"><input type="submit" name="all_history" value="All History"></td>
			</tr>
			<tr class="gap" />
		</table>
		</form>
		<br> <br>
		<table align="center" style="border-collapse: collapse; min-width: 1000px;" border="1" class="viewTransfer">
			
			<?php 
				include_once '../../database/fetch_data.php';
				
				if(isset($_POST["all_history"]))
				{
					echo 
					"<tr>
						<th>Transfer Id</th>
						<th>User</th>
						<th>Transferred To</th>
						<th>A/C or Card No.</th>
						<th>Amount</th>
						<th>Date & Time</th>
						<th>Short Note</th>
					</tr>";

					$table=fetch_all_transfer();
					while ($row=mysqli_fetch_array($table)) {
					echo "

						<tr>
							<td align='center'>". $row['TRANSFER_ID'] . "</td>
							<td align='center'>" .$row['F_NAME'] ." ".$row['L_NAME'] . "</td>
							<td align='center'>" .$row['TRANSFERRED_TO'] . "</td>
							<td align='center'>" .$row['ACC_CARD_NUM'] . "</td>
							<td align='center'>" . $row['AMOUNT'] . "</td>
							<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
							<td align='center'>" . $row['SHORT_NOTE'] . "</td>
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
                    	echo 
							"<tr>
								<th>Transfer Id</th>
								<th>User</th>
								<th>Transferred To</th>
								<th>A/C or Card No.</th>
								<th>Amount</th>
								<th>Date & Time</th>
								<th>Short Note</th>
							</tr>";

							$table=fetch_transfer_by_date_and_identity($fromDate, $toDate, $identity);
							while ($row=mysqli_fetch_array($table)) {
							echo "

								<tr>
									<td align='center'>". $row['TRANSFER_ID'] . "</td>
									<td align='center'>" .$row['F_NAME'] ." ".$row['L_NAME'] . "</td>
									<td align='center'>" .$row['TRANSFERRED_TO'] . "</td>
									<td align='center'>" .$row['ACC_CARD_NUM'] . "</td>
									<td align='center'>" . $row['AMOUNT'] . "</td>
									<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
									<td align='center'>" . $row['SHORT_NOTE'] . "</td>
								";
								
							}
                    }
                    else if(isset($fromDate) && isset($toDate))
                    {
                    	echo 
							"<tr>
								<th>Transfer Id</th>
								<th>User</th>
								<th>Transferred To</th>
								<th>A/C or Card No.</th>
								<th>Amount</th>
								<th>Date & Time</th>
								<th>Short Note</th>
							</tr>";

							$table=fetch_transfer_by_date($fromDate,$toDate);
							while ($row=mysqli_fetch_array($table)) {
							echo "

								<tr>
									<td align='center'>". $row['TRANSFER_ID'] . "</td>
									<td align='center'>" .$row['F_NAME'] ." ".$row['L_NAME'] . "</td>
									<td align='center'>" .$row['TRANSFERRED_TO'] . "</td>
									<td align='center'>" .$row['ACC_CARD_NUM'] . "</td>
									<td align='center'>" . $row['AMOUNT'] . "</td>
									<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
									<td align='center'>" . $row['SHORT_NOTE'] . "</td>
								";
								
							}
                    }
                    else if(isset($identity))
                    {
                    	echo 
							"<tr>
								<th>Transfer Id</th>
								<th>User</th>
								<th>Transferred To</th>
								<th>A/C or Card No.</th>
								<th>Amount</th>
								<th>Date & Time</th>
								<th>Short Note</th>
							</tr>";

							$table=fetch_transfer_by_identity($identity);
							while ($row=mysqli_fetch_array($table)) {
							echo "

								<tr>
									<td align='center'>". $row['TRANSFER_ID'] . "</td>
									<td align='center'>" .$row['F_NAME'] ." ".$row['L_NAME'] . "</td>
									<td align='center'>" .$row['TRANSFERRED_TO'] . "</td>
									<td align='center'>" .$row['ACC_CARD_NUM'] . "</td>
									<td align='center'>" . $row['AMOUNT'] . "</td>
									<td align='center'>" . $row['TRANSFER_TIME'] . "</td>
									<td align='center'>" . $row['SHORT_NOTE'] . "</td>
								";
								
							}
                    }
				}
				

			 ?>
			<tr class="gap" />
		</table>
		<br>
		<table align="center" style="min-width: 1000px; border-collapse: collapse;">
			<?php 
				include_once '../../database/fetch_data.php';
				$total = 0;
				if(isset($_POST["all_history"]))
	            {
	                $table=fetch_all_transfer();
	            }
	            else if(isset($fromDate) && isset($toDate) && isset($identity))
	            {
	                $table=fetch_transfer_by_date_and_identity($fromDate,$toDate,$identity);
	            }
	            else if(isset($fromDate) && isset($toDate))
	            {
	                $table=fetch_transfer_by_date($fromDate,$toDate);
	            }
	            else if(isset($identity))
	            {
	                $table=fetch_transfer_by_identity($_POST["identity"]);
	            }
	            if(isset($table))
	            {
	            	while ($row=mysqli_fetch_array($table)) 
	            	{
						$total+=$row['AMOUNT'];
					}
	                echo "
	            
	                <tr>
						<td align='center'>
							<b> Total : </b>
							<b>".$total."</b>
							<b> $ </b>
						</td>
					  </tr>
	                ";
	            }
			 ?>
			
		</table>
	</div>
</body>
</html>