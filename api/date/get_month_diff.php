<?php
require_once('../config.php');
require_once('../function.php');
$err = "";
$pass = "";
$token = "";
$device_type = "";
define('ROOTPATH', dirname(__FILE__));

$file = fopen("../logs/" . date("d-m-y") . ".txt", "a");
fwrite($file, (ROOTPATH . "/get_month_diff.php," . file_get_contents('php://input') . "\n"));

$response = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    header("Content-Type:application/json");
    $data = json_decode(file_get_contents('php://input'), true);
    // condition to check request in json 
    // if(strpos($content_type, "application/json") !== false){
        // print_r($data);
    if (isset($data['start_date']) && isset($data['end_date']) ) {
        $end_month = $data['end_date'];
        $start_month = $data['start_date'];
        $response = array('success'=>true,
        'data' => array('month_diff'=>cal_month($start_month,$end_month)+1,'end_month'=>month_name($end_month))
 
    );
        

    }
    else{
        $err = 'set_key = start_date, end_date';
    }
}
else $err = 'Send request in POST Method';
sendPostRes($response, $err);
?>