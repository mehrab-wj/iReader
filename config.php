<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ireader";

$con = mysqli_connect($host, $username, $password);
if (!$con){
    die("Database Connection Failed :( <br>" . mysqli_error($con));
}
$select_db = mysqli_select_db($con, $dbname);
if (!$select_db){
    die("Database Selection Failed :! <br>" . mysqli_error($con));
}
mysqli_query($con,"SET NAMES 'utf8mb4'");
mysqli_query($con,"SET CHARACTER SET 'utf8mb4'");
mysqli_query($con,"SET character_set_connection = 'utf8mb4'");

 ?>
