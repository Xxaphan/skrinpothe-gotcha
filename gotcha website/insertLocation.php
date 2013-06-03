<?php
$dbhost  = 'localhost';
$dbname  = 'DB_10003225';
$dbuser  = 'U_10003225';
$dbpass  = 'Zxksupje3htsEAZM'; 

$con = mysql_connect($dbhost, $dbuser, $dbpass);

if($con == FALSE)
{
    echo 'Cannot connect to database' . mysql_error();
}
else
{
    echo 'Connected to database';
}

//$userid = 1;
//$long = '999999';
//$lat = '8888888';
echo '<br />';
$userid = $_POST['userid']; 
$long = $_POST['longt']; 
$lat = $_POST['lat']; 

echo 'userid: ' . $userid . ' lonti: ' . $long . ' lat: ' . $lat;

mysql_select_db($dbname, $con);

 
$sql = 'UPDATE gotcha_user_location SET longt="'.$long.'", lat="'.$lat.'" WHERE user = ' .$userid . ' ';


if (!mysql_query($sql, $con))
{
    echo '<br />';
    die('Error: ' . mysql_error());
}
echo '<br />';
echo "1 record updated";

mysql_close($con)
?>
