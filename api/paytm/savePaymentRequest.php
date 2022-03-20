<?php
require_once('../config.php');
require_once('../function.php');
$err = "";
$pass = "";
$token = "";
$device_type = "";
define('ROOTPATH', dirname(__FILE__));

$file = fopen("../logs/" . date("d-m-y") . ".txt", "a");
fwrite($file, (ROOTPATH . "/add.php," . file_get_contents('php://input') . "\n"));

$response = "";
$funResponse = array(
    "error" => false,
    "msg" => "",
    "success" => true,
);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    header("Content-Type:application/json");
    $data = json_decode(file_get_contents('php://input'), true);
    // condition to check request in json 
    // if(strpos($content_type, "application/json") !== false){
    // print_r($data);
    if (isset($data)) {

        $orderid = $data['orderid'];
        $amt = $data['amt'];
        $student = $data['student'];

        //data initialize data.body
        $data = $data['body'];
        $result = $data['resultInfo'];
        $txnToken = $data['txnToken'];
        $responseTimestamp = $result['responseTimestamp'];
        $resultStatus = $result['resultStatus'];
        $resultCode = $result['resultCode'];
        isExist($con, "orderid", $txnToken, "payment_info");
        if ($funResponse['success']) {
            die(sendPostRes(false, "This $orderid already proceed,wait for confirmation or try to start a new payment..."));
        }


        if ($result = mysqli_query($con, "INSERT INTO `payment_info`( `student_id`, `txn_amt`, `orderid`, `responseTimestamp`, `resultStatus`, `resultCode`) VALUES($student,$txnToken,$amt,$orderid,$responseTimestamp,$resultStatus,$resultCode)")) {
            if ($res = mysqli_num_rows($result)) {


                $response = array(
                    "success" => true,
                    "error" => ""
                );
            } else {
                $err = mysqli_error($con);
            }
        } else {
            $err = mysqli_error($con);
        }
    } else {
        $err = "send required parameters` ";
    }
} else {
    $err = "Header should be POST";
}
sendPostRes($response, $err);

function isExist($con, $key, $value, $table)
{
    global $funResponse;
    $sql = "SELECT $key from $table WHERE $key = $value";
    if ($res = mysqli_query($con, $sql))
        if (mysqli_num_rows($res) > 0)
            $funResponse['success'] = true;
        else
            $funResponse['success'] = false;
    else {
        $funResponse['error'] = true;
        $funResponse['msg'] = mysqli_error($con);
    }
    isError();
}

function isError()
{
    global $funResponse;
    if ($funResponse['error'] == true) {
        die(sendPostRes($funResponse, $funResponse['error']));
    }
}
