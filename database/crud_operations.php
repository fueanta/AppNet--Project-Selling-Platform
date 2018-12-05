<?php
include_once 'mysqli_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// generalized functions

function execution($query)
{
    // database connection
    $connection = get_db_connection();

    // execution of operation
    $execution_status = (bool) mysqli_query($connection, $query);

    // closing the connection after getting the table!
    mysqli_close($connection);

    // returning if data has been inserted or not
    return $execution_status;
}

function insertion($query)
{
    // message to show
    $msg = "Record could not be inserted!";
    if (execution($query))
    {
        $msg = "Record has been inserted successfully";
    }

    // returning message
    return $msg;
}

function updation($query)
{
    // message to show
    $msg = "Record could not be updated!";
    if (execution($query))
    {
        $msg = "Record has been updated successfully";
    }

    // returning message
    return $msg;
}

function deletion($query)
{
    // message to show
    $msg = "Record could not be deleted!";
    if (execution($query))
    {
        $msg = "Record has been deleted successfully";
    }

    // returning message
    return $msg;
}

// insert operations
function insert_admin_data($user_name, $password, $details)
{
    // query to execute
    $query = "INSERT INTO ADMIN (USER_NAME, PASSWORD) VALUES ('$user_name', '$password')";

    // attempting to insert admin & returning back execution status
    return insertion($query);
}

function insert_user_data($fn, $ln, $db, $ph, $em, $pass, $cntr, $cty, $ste, $pcode, $addr)
{
    // query to execute

    $query = "INSERT INTO USER (F_NAME, L_NAME, DOB, PHONE, EMAIL, COUNTRY, CITY, STATE, ADDRESS, P_CODE, PASSWORD) VALUES ('$fn', '$ln', '$db', '$ph', '$em', '$cntr', '$cty', '$ste', '$addr', '$pcode', '$pass')";
    // attempting to insert admin & returning back execution status
    return insertion($query);
}

function insert_card_data($cn, $ch, $ed, $sn, $id)
{
    // query to execute
    $query = "INSERT INTO CARD (CARD_NUM, CARD_HOLDER, EXP_DATE, SECURITY_NUM, USER_ID) VALUES ('$cn', '$ch', '$ed', '$sn', '$id')";

    // attempting to insert admin & returning back execution status
    return insertion($query);
}

function insert_bank_data($ban, $bac, $acn, $swc, $rcn, $rct, $rcc, $rcct, $rca, $id)
{
    // query to execute
    $query = "INSERT INTO BANK (BANK_NAME, BANK_COUNTRY, ACCOUNT_NO, SWIFT_CODE, REC_NAME, REC_TYPE, REC_COUNTRY, REC_CITY, REC_ADDRESS, USER_ID) VALUES ('$ban', '$bac', '$acn', '$swc', '$rcn', '$rct', '$rcc', '$rcct', '$rca', '$id')";

    // attempting to insert admin & returning back execution status
    return insertion($query);
}

function insert_transfer_data($trans_to, $acc_num, $amount, $note, $id)
{
    $query = "INSERT INTO TRANSFER (TRANSFERRED_TO, ACC_CARD_NUM, AMOUNT, SHORT_NOTE, USER_ID) VALUES ('$trans_to', '$acc_num', '$amount', '$note', '$id')";
    insertion($query);
    $bal = $_SESSION['balance'];
    $query = "UPDATE USER SET BALANCE='$bal' WHERE user_id='$id'";
    return updation($query);
}

function insert_project($id, $title, $price, $desc, $feature, $tools, $icon, $size, $link, $discount, $platform, $category, $user_id)
{
    // query to execute
    $query = "INSERT INTO PROJECT (PROJECT_ID, TITLE, PRICE, DESCRIPTION, FEATURES, TOOLS, ICON, SIZE, LINK, DISCOUNT, PLATFORM, CATEGORY, USER_ID) VALUES
    ('$id', '$title', '$price', '$desc', '$feature', '$tools', '$icon', '$size', '$link', '$discount','$platform', '$category', '$user_id')";
    return insertion($query);
}

function insert_snapshot($snaps, $p_id)
{
    // query to execute
    for ($i = 0; $i < sizeof($snaps); $i++)
    {
      $query = "INSERT INTO SNAPSHOT (FILE_NAME, PROJECT_ID) VALUES ('$snaps[$i]', '$p_id')";
      insertion($query);
    }
}

function insert_transaction($buyer, $seller, $project, $selling_price, $method)
{
    $query = "INSERT INTO TRANSACTION (BUYER_ID, SELLER_ID, PROJECT_ID, SELLING_PRICE, BUYING_METHOD) VALUES ('$buyer', '$seller', '$project', '$selling_price', '$method')";
    insertion($query);
    if ($method == "Account") {
      $query = "UPDATE USER SET BALANCE = BALANCE - '$selling_price' WHERE USER_ID = '$buyer'";
      updation($query);
    }
    $query = "UPDATE USER SET BALANCE = BALANCE + '$selling_price' WHERE USER_ID = '$seller'";
    updation($query);
}

// update operations
function update_user_data($fn, $ln, $db, $ph, $em, $pass, $cntr, $cty, $ste, $pcode, $addr, $id)
{
    $query = "UPDATE USER SET F_NAME='$fn',L_NAME='$ln',DOB='$db',Phone='$ph',EMAIL='$em', COUNTRY='$cntr', CITY='$cty', STATE='$ste', ADDRESS='$addr', P_CODE='$pcode', PASSWORD='$pass' WHERE user_id='$id'";

    return updation($query);
}

function update_card_data($cn, $ch, $ed, $sn, $id)
{
    $query = "UPDATE CARD SET CARD_NUM='$cn',CARD_HOLDER='$ch',EXP_DATE='$ed',SECURITY_NUM='$sn' WHERE user_id='$id'";

    return updation($query);
}

function update_bank_data($ban, $bac, $acn, $swc, $rcn, $rct, $rcc, $rcct, $rca, $id)
{
    $query = "UPDATE BANK SET BANK_NAME='$ban',BANK_COUNTRY='$bac',ACCOUNT_NO='$acn',SWIFT_CODE='$swc',REC_NAME='$rcn',REC_TYPE='$rct',REC_COUNTRY='$rcc',REC_CITY='$rcct',REC_ADDRESS='$rca' WHERE user_id='$id'";

    return updation($query);
}

function update_project($title, $price, $desc, $feature, $tools, $size, $link, $discount, $platform, $category, $project_id)
{
    $query = "UPDATE PROJECT SET TITLE = '$title', PRICE = '$price', DESCRIPTION = '$desc', FEATURES = '$feature', TOOLS = '$tools', SIZE = '$size', LINK = '$link', DISCOUNT = '$discount', PLATFORM = '$platform', CATEGORY = '$category' WHERE PROJECT_ID = '$project_id'";

    return updation($query);
}

// delete operations
function delete_card_data($id)
{
  $query = "DELETE FROM CARD WHERE user_id='$id'";

  return deletion($query);
}

function delete_bank_data($id)
{
  $query = "DELETE FROM BANK WHERE user_id='$id'";

  return deletion($query);
}

function delete_project($id)
{
  $query = "DELETE FROM PROJECT WHERE PROJECT_ID = '$id'";
  deletion($query);
}

function delete_snapshot($project)
{
  $query = "DELETE FROM SNAPSHOT WHERE PROJECT_ID = '$project'";
  deletion($query);
}

//jamil & adit

function delete_user($id)
{
    $query = "DELETE FROM user where user_id=$id";

    return deletion($query);
}

function change_admin_pass($pass)
{
    $query = "UPDATE admin set password='$pass'";

    return deletion($query);
}

function update_forgot_email($email)
{
    $pass=rand(1000,9999);
    $query= "UPDATE USER SET PASSWORD='$pass' WHERE EMAIL='$email'";

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'jhasnat07@gmail.com';                 // SMTP username
        $mail->Password = 'jackal2016';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('jhasnat07@gmail.com', 'Admin');
        $mail->addAddress($email);     // Add a recipient

        //Content
        $mail->Subject = 'Password reset';
        $mail->Body    = 'your new password is '.$pass;

        $mail->send();
        echo '<b>Your new password has been sent to your email.</b><br>';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    //echo "your password is ".$pass."<br>";

    return updation($query);


}

?>
