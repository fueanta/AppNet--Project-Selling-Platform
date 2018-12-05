<!DOCTYPE html>
<html>
<head>
    <title>Appnet | Admin</title>
    <link rel="stylesheet" type="text/css" href="../../css/AdminDashboardStyle.css">
</head>
<body>
    <div align='center'>
        <span class="heading">
                    Projects
        </span>     
        <hr/>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table max-width: 300px;>
            <tr>
                <td>
                    From Date (Added)
                </td>
                <td align="left">
                    <input style="min-width: 150px;" type="date" name="fromDate">
                </td>
            </tr>
            <tr>
                <td>
                    To Date (Added)
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
                    <input placeholder="Id, Platform, Category.." style="min-width: 150px; min-height: 18px;" type="text" name="identity" value="">
                </td>
            </tr>
            
            <tr>
                <td align="left"><input type="submit" name="search" value="Show History"></td>
                <td align="left"><input type="submit" name="all_history" value="All History"></td>
            </tr>
            <tr class="gap" />
        </table>
    </form>
        <br> <br>
        <table align="center" style="border-collapse: collapse; min-width: 1000px;" border="1" class="viewProject">
            
            <?php 
                include_once '../../database/fetch_data.php';

                if(isset($_POST["all_history"]))
                {
                    echo 
                    "<tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Platform</th>
                    <th>Date Added</th>
                    <th>Price</th>
                    </tr>";

                    $table=fetch_all_project();

                    while ($row=mysqli_fetch_array($table)) {
                        echo "

                        <tr>
                            <td align='center'>" . $row['PROJECT_ID'] . "</td>
                            <td align='center'>" . $row['TITLE']. "</td>
                            <td align='center'>" . $row['PLATFORM'] . "</td>
                            <td align='center'>" . "$" . $row['TIME_ADDED'] . "</td>
                            <td align='center'>" . "$" . $row['PRICE'] . "</td>
                        </tr>
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
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th>Platform</th>
                        <th>Date Added</th>
                        <th>Price</th>
                        </tr>";

                        $table=fetch_project_by_date_and_identity($fromDate,$toDate,$identity);

                        while ($row=mysqli_fetch_array($table)) {
                            echo "

                            <tr>
                                <td align='center'>" . $row['PROJECT_ID'] . "</td>
                                <td align='center'>" . $row['TITLE']. "</td>
                                <td align='center'>" . $row['PLATFORM'] . "</td>
                                <td align='center'>" . "$" . $row['TIME_ADDED'] . "</td>
                                <td align='center'>" . "$" . $row['PRICE'] . "</td>
                            </tr>
                            ";
                        }
                    }
                    else if(isset($fromDate) && isset($toDate))
                    {
                        echo 
                        "<tr>
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th>Platform</th>
                        <th>Date Added</th>
                        <th>Price</th>
                        </tr>";

                        $table=fetch_transaction_by_date($fromDate, $toDate);

                        while ($row=mysqli_fetch_array($table)) {
                            echo "

                            <tr>
                                <td align='center'>" . $row['PROJECT_ID'] . "</td>
                                <td align='center'>" . $row['TITLE']. "</td>
                                <td align='center'>" . $row['PLATFORM'] . "</td>
                                <td align='center'>" . "$" . $row['TIME_ADDED'] . "</td>
                                <td align='center'>" . "$" . $row['PRICE'] . "</td>
                            </tr>
                            ";
                        }
                    }

                    else if(isset($identity))
                    {
                        echo 
                        "<tr>
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th>Platform</th>
                        <th>Date Added</th>
                        <th>Price</th>
                        </tr>";

                        $table=fetch_project_by_identity($identity);

                        while ($row=mysqli_fetch_array($table)) {
                            echo "

                            <tr>
                                <td align='center'>" . $row['PROJECT_ID'] . "</td>
                                <td align='center'>" . $row['TITLE']. "</td>
                                <td align='center'>" . $row['PLATFORM'] . "</td>
                                <td align='center'>" . "$" . $row['TIME_ADDED'] . "</td>
                                <td align='center'>" . "$" . $row['PRICE'] . "</td>
                            </tr>
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

            if(isset($_POST["all_history"]))
            {
                $table=fetch_all_project();
            }
            else if(isset($fromDate) && isset($toDate) && isset($identity))
            {
                $table=fetch_project_by_date_and_identity($fromDate,$toDate,$identity);
            }
            else if(isset($fromDate) && isset($toDate))
            {
                $table=fetch_project_by_date($fromDate,$toDate);
            }
            else if(isset($identity))
            {
                $table=fetch_project_by_identity($_POST["$identity"]);
            }
            if(isset($table)){
                echo "
            
                <tr>
                    <td align='center'>
                        <b><u>Total Count</u></b>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        <b>[".$table->num_rows."]</b>
                    </td>
                </tr>
                ";
            }
         ?>
    </div>
</body>
</html>