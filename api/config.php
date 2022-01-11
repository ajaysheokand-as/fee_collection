<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "fee_collection";
$con = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_errno()){
    die("error");
}
// else{
//     echo ("Connection Successfull"); 
// }
date_default_timezone_set("Asia/Calcutta");
