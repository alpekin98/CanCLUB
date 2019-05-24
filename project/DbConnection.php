<?php
$host = "localhost";
$root = "root";
$password_root= "12345678";
$database = "webproject";

$DB_Connection = mysqli_connect($host,$root,$password_root,$database);
if (mysqli_connect_errno())
    echo "Connection could not be established." . mysqli_connect_error();
?>
