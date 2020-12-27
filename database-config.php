<?php 
$db_host = 'localhost';
$db_username = 'id15345931_database';
$db_password = 'PHPdatabase_2020';
$db_name = 'id15345931_evaluation_system_database';

$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if(!$con){
    die('Error : ('. $con->connect_errno .')'. $con->connect_error);
}
?>  