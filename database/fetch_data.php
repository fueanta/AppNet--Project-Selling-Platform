<?php
include_once 'mysqli_connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// function that takes the query as parameter and returns the table as 2D array
function fetch_data($query)
{
    // response to be sent on request,
    $response = null;

    // database connection
    $connection = get_db_connection();

    // database sends the table itself against the query!!
    $table = @mysqli_query($connection, $query);

    // closing the connection after getting the table!
    mysqli_close($connection);

    // if the table is as required,
    if ($table)
    {
        // our response will be the table itself
        $response = $table;
    }
    else
    {
        // handing if exception occurs
        echo 'Unable to execute the following query: ', '<b>$query</b>', '\n';
        echo mysqli_error($connection);
    }

    // returning our response to the calling function
    return $response;
}

function fetch_user_by_phone_email($phone, $email)
{
    $query = "SELECT COUNT(*) AS 'EXISTS' FROM USER WHERE PHONE = '$phone' OR EMAIL = '$email'";
    $table = fetch_data($query);
    $row = mysqli_fetch_array($table);
    // echo $row['EXISTS'];
    return ($row['EXISTS'] == 1 ? true : false);
}

function fetch_user_on_login($phone_or_email, $password)
{
    $query = "SELECT user_id, f_name, l_name, dob, phone, email, country, city, state, address, p_code, balance, password, added_time FROM USER WHERE PHONE = '$phone_or_email' OR EMAIL = '$phone_or_email' AND PASSWORD = '$password'";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function fetch_card_info($usr_id)
{
    $query = "SELECT card_holder, card_num, exp_date, security_num FROM CARD WHERE USER_ID = '$usr_id'";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function fetch_bank_info($usr_id)
{
    $query = "SELECT bank_id, bank_name, bank_country, swift_code, account_no, rec_name, rec_type, rec_country, rec_city, rec_address FROM BANK WHERE USER_ID = '$usr_id'";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function fetch_transfer_for_user($from, $to, $usr_id)
{
    $query = "SELECT TRANSFER_ID, TRANSFERRED_TO, ACC_CARD_NUM, AMOUNT, TRANSFER_TIME, SHORT_NOTE FROM TRANSFER WHERE USER_ID = '$usr_id' AND STR_TO_DATE(DATE_FORMAT(TRANSFER_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}

function fetch_uploaded_project_for_user($usr_id)
{
    $query = "SELECT PROJECT_ID, TITLE, ICON FROM PROJECT WHERE USER_ID = '$usr_id'";
    return ($table = fetch_data($query));
}

function fetch_purchased_project_for_user($usr_id)
{
    $query = "SELECT p.PROJECT_ID , p.TITLE, p.ICON FROM PROJECT p, TRANSACTION t WHERE t.BUYER_ID = '$usr_id' AND p.PROJECT_ID = t.PROJECT_ID";
    return ($table = fetch_data($query));
}

function fetch_snapshot($project_id)
{
    $query = "SELECT SNAP_ID, FILE_NAME FROM SNAPSHOT WHERE PROJECT_ID = '$project_id'";
    return ($table = fetch_data($query));
}

function fetch_project($project_id)
{
    $query = "SELECT TITLE, PRICE, DESCRIPTION, FEATURES, TOOLS, ICON, SIZE, LINK, DISCOUNT, PLATFORM, CATEGORY, UP_VOTE, DOWN_VOTE, TIME_ADDED, p.USER_ID, F_NAME, L_NAME FROM PROJECT p, USER u WHERE PROJECT_ID = '$project_id' AND p.USER_ID = u.USER_ID";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function fetch_purchase($from, $to, $user_id)
{
    $query = "SELECT p.TITLE, s.F_NAME, s.L_NAME, t.TRANSACTION_TIME, t.SELLING_PRICE FROM TRANSACTION t, PROJECT p, USER s WHERE t.BUYER_ID = '$user_id' AND t.SELLER_ID = s.USER_ID AND t.PROJECT_ID = p.PROJECT_ID AND STR_TO_DATE(DATE_FORMAT(t.TRANSACTION_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}

function fetch_sale($from, $to, $user_id)
{
    $query = "SELECT p.TITLE, b.F_NAME, b.L_NAME, t.TRANSACTION_TIME, t.SELLING_PRICE FROM TRANSACTION t, PROJECT p, USER b WHERE t.SELLER_ID = '$user_id' AND t.BUYER_ID = b.USER_ID AND t.PROJECT_ID = p.PROJECT_ID AND STR_TO_DATE(DATE_FORMAT(t.TRANSACTION_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}

function fetch_project_by_platform($platform)
{
    $query = "SELECT PROJECT_ID, TITLE, ICON, PRICE FROM PROJECT WHERE PLATFORM = '$platform'";
    return ($table = fetch_data($query));
}

// jamil & adit work from 71

function fetch_all_user()
{
    $query= "SELECT USER_ID,F_NAME,L_NAME,PHONE,ADDED_TIME FROM USER";
        return ($table = fetch_data($query));
}

function fetch_user_by_identity($identity)
{
    $query= "SELECT USER_ID,F_NAME,L_NAME,PHONE,ADDED_TIME FROM USER WHERE USER_ID LIKE '%$identity%' or F_NAME LIKE '%$identity%' or L_NAME LIKE '%$identity%' or PHONE LIKE '%$identity%'";
        return ($table = fetch_data($query));
}

function fetch_user_by_date($from, $to)
{
    $query = "SELECT USER_ID,F_NAME,L_NAME,PHONE,ADDED_TIME FROM USER WHERE STR_TO_DATE(DATE_FORMAT(ADDED_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}

function fetch_user_by_date_and_identity($from, $to, $identity)
{
    $query = "SELECT USER_ID,F_NAME,L_NAME,PHONE,ADDED_TIME FROM USER WHERE (STR_TO_DATE(DATE_FORMAT(ADDED_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')) AND (USER_ID LIKE '%$identity%' or F_NAME LIKE '%$identity%' or L_NAME LIKE '%$identity%' or PHONE LIKE '%$identity%')";
    return ($table = fetch_data($query));
}

function fetch_all_project()
{
    $query= "SELECT PROJECT_ID,TITLE,PLATFORM,TIME_ADDED,PRICE FROM PROJECT";
        return ($table = fetch_data($query));
}

function fetch_project_by_identity($identity)
{
    $query= "SELECT PROJECT_ID,TITLE,PLATFORM,TIME_ADDED,PRICE FROM PROJECT WHERE PROJECT_ID LIKE '%$identity%' or TITLE LIKE '%$identity%' or PLATFORM LIKE '%$identity%' or TIME_ADDED LIKE '%$identity%' or PRICE LIKE '%$identity%'";
        return ($table = fetch_data($query));
}

function fetch_project_by_date($from, $to)
{
    $query = "SELECT PROJECT_ID,TITLE,PLATFORM,TIME_ADDED,PRICE FROM PROJECT WHERE STR_TO_DATE(DATE_FORMAT(TIME_ADDED, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}

function fetch_project_by_date_and_identity($from, $to, $identity)
{
    $query = "SELECT PROJECT_ID,TITLE,PLATFORM,TIME_ADDED,PRICE FROM PROJECT WHERE (STR_TO_DATE(DATE_FORMAT(TIME_ADDED, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')) AND (PROJECT_ID LIKE '%$identity%' or TITLE LIKE '%$identity%' or PLATFORM LIKE '%$identity%' or TIME_ADDED LIKE '%$identity%' or PRICE LIKE '%$identity%')";
    return ($table = fetch_data($query));
}

function fetch_all_transaction()
{
    $query = "SELECT p.TITLE project_name, b.F_NAME buyer_f_name, b.L_NAME buyer_l_name, s.F_NAME seller_f_name, s.L_NAME seller_l_name, t.TRANSACTION_TIME transaction_time, t.SELLING_PRICE selling_price FROM PROJECT p, USER b, USER s, TRANSACTION t WHERE p.PROJECT_ID = t.PROJECT_ID AND b.USER_ID = t.BUYER_ID AND s.USER_ID = t.SELLER_ID";

    return ($table = fetch_data($query));
}
function fetch_transaction_by_identity($identity)
{
    $query = "SELECT p.TITLE project_name, b.F_NAME buyer_f_name, b.L_NAME buyer_l_name, s.F_NAME seller_f_name, s.L_NAME seller_l_name, t.TRANSACTION_TIME transaction_time, t.SELLING_PRICE selling_price FROM PROJECT p, USER b, USER s, TRANSACTION t WHERE (p.PROJECT_ID = t.PROJECT_ID AND b.USER_ID = t.BUYER_ID AND s.USER_ID = t.SELLER_ID) AND (p.TITLE LIKE '%$identity%' or b.F_NAME LIKE '%$identity%' or b.L_NAME LIKE '%$identity%' or s.F_NAME LIKE '%$identity%' or s.L_NAME LIKE '%$identity%' or t.TRANSACTION_TIME LIKE '%$identity%' or t.SELLING_PRICE LIKE '%$identity%')";
        return ($table = fetch_data($query));
}

function fetch_transaction_by_date($from, $to)
{
    $query = "SELECT p.TITLE project_name, b.F_NAME buyer_f_name, b.L_NAME buyer_l_name, s.F_NAME seller_f_name, s.L_NAME seller_l_name, t.TRANSACTION_TIME transaction_time, t.SELLING_PRICE selling_price FROM PROJECT p, USER b, USER s, TRANSACTION t WHERE (p.PROJECT_ID = t.PROJECT_ID AND b.USER_ID = t.BUYER_ID AND s.USER_ID = t.SELLER_ID) AND (STR_TO_DATE(DATE_FORMAT(t.TRANSACTION_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d'))";
    return ($table = fetch_data($query));
}

function fetch_transaction_by_date_and_identity($from, $to, $identity)
{
    $query = "SELECT p.TITLE project_name, b.F_NAME buyer_f_name, b.L_NAME buyer_l_name, s.F_NAME seller_f_name, s.L_NAME seller_l_name, t.TRANSACTION_TIME transaction_time, t.SELLING_PRICE selling_price FROM PROJECT p, USER b, USER s, TRANSACTION t WHERE (p.PROJECT_ID = t.PROJECT_ID AND b.USER_ID = t.BUYER_ID AND s.USER_ID = t.SELLER_ID) AND (STR_TO_DATE(DATE_FORMAT(t.TRANSACTION_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')) AND (p.TITLE LIKE '%$identity%' or b.F_NAME LIKE '%$identity%' or b.L_NAME LIKE '%$identity%' or s.F_NAME LIKE '%$identity%' or s.L_NAME LIKE '%$identity%' or t.TRANSACTION_TIME LIKE '%$identity%' or t.SELLING_PRICE LIKE '%$identity%')";
    return ($table = fetch_data($query));
}


function fetch_all_transfer()
{
    $query="SELECT TRANSFER_ID,F_NAME,L_NAME,TRANSFERRED_TO,ACC_CARD_NUM,AMOUNT,TRANSFER_TIME,SHORT_NOTE FROM TRANSFER INNER JOIN USER ON TRANSFER.USER_ID=USER.USER_ID";
    return ($table = fetch_data($query));

}
function fetch_transfer_by_identity($identity)
{
    $query= "SELECT TRANSFER_ID,F_NAME,L_NAME,TRANSFERRED_TO,ACC_CARD_NUM,AMOUNT,TRANSFER_TIME,SHORT_NOTE FROM TRANSFER INNER JOIN USER ON TRANSFER.USER_ID=USER.USER_ID WHERE TRANSFER_ID LIKE '%$identity%' or F_NAME LIKE '%$identity%' or L_NAME LIKE '%$identity%' or TRANSFERRED_TO LIKE '%$identity%' or ACC_CARD_NUM LIKE '%$identity%' or AMOUNT LIKE '%$identity%' or TRANSFER_TIME LIKE '%$identity%' or SHORT_NOTE LIKE '%$identity%'";
        return ($table = fetch_data($query));
}

function fetch_transfer_by_date($from, $to)
{
    $query = "SELECT TRANSFER_ID,F_NAME,L_NAME,TRANSFERRED_TO,ACC_CARD_NUM,AMOUNT,TRANSFER_TIME,SHORT_NOTE FROM TRANSFER INNER JOIN USER ON TRANSFER.USER_ID=USER.USER_ID WHERE STR_TO_DATE(DATE_FORMAT(TRANSFER_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')";
    return ($table = fetch_data($query));
}
function fetch_transfer_by_date_and_identity($from, $to, $identity)
{
    $query = "SELECT TRANSFER_ID,F_NAME,L_NAME,TRANSFERRED_TO,ACC_CARD_NUM,AMOUNT,TRANSFER_TIME,SHORT_NOTE FROM TRANSFER INNER JOIN USER ON TRANSFER.USER_ID=USER.USER_ID WHERE (STR_TO_DATE(DATE_FORMAT(TRANSFER_TIME, '%Y-%m-%d'), '%Y-%m-%d') BETWEEN STR_TO_DATE('$from', '%Y-%m-%d') AND STR_TO_DATE('$to', '%Y-%m-%d')) AND (TRANSFER_ID LIKE '%$identity%' or F_NAME LIKE '%$identity%' or L_NAME LIKE '%$identity%' or TRANSFERRED_TO LIKE '%$identity%' or ACC_CARD_NUM LIKE '%$identity%' or AMOUNT LIKE '%$identity%' or TRANSFER_TIME LIKE '%$identity%' or SHORT_NOTE LIKE '%$identity%')";
    return ($table = fetch_data($query));
}
function fetch_admin()
{
    $query = "Select password from admin";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}
function fetch_icons_by_platform($platform)
{
    $query = "SELECT ICON FROM PROJECT WHERE PLATFORM = '$platform'";
    return($table = fetch_data($query));
}

function get_owned_project_by_id($project_id, $user_id)
{
    $query = "SELECT PROJECT_ID FROM TRANSACTION WHERE PROJECT_ID = '$project_id' AND BUYER_ID = '$user_id'";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function get_uploaded_project_by_id($project_id, $user_id)
{
    $query = "SELECT PROJECT_ID FROM PROJECT WHERE PROJECT_ID = '$project_id' AND USER_ID = '$user_id'";
    $table = fetch_data($query);
    return ($row = mysqli_fetch_array($table));
}

function get_email($email)
{
    $query="SELECT EMAIL FROM USER WHERE EMAIL='$email'";
    return($table = fetch_data($query));
}

function fetch_project_titles()
{
    $query="SELECT title FROM project";
    return($table = fetch_data($query));
}

function fetch_project_by_search($search)
{
    $query = "SELECT PROJECT_ID, TITLE, ICON FROM PROJECT WHERE TITLE LIKE '%$search%'";
    return ($table = fetch_data($query));
}

?>
