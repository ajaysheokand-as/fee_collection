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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    header("Content-Type:application/json");
    $data = json_decode(file_get_contents('php://input'), true);
    // condition to check request in json 
    // if(strpos($content_type, "application/json") !== false){
        // print_r($data);
    if (isset($data['student_adm_no']) && isset($data['receipt_no']) && isset($data['receipt_no']) && isset($data['concession']) && isset($data['fee_paid']) && isset($data['month']) && isset($data['mode']) ) {
        $student_adm_no = $data['student_adm_no'];
        $receipt_no = $data['receipt_no'];
        $subtotal = $data['subtotal'];
        $concession = $data['concession'];
        $fee_paid = $data['fee_paid'];
        $month = $data['month'];
        $mode = $data['mode'];
        // $category =  filter_var($data['category'], FILTER_SANITIZE_STRING);
        if ($result = mysqli_query($con, "SELECT receipt_no FROM `student_fee_record` where receipt_no = $receipt_no ")) {
            if (mysqli_num_rows($result) < 1) {
                $sql = "INSERT INTO `student_fee_record`(`receipt_no`, `student_adm_no`, `amount`, `concession`, `fee_paid`, `months`, `mode`) VALUES  ('$receipt_no', '$student_adm_no', '$subtotal', '$concession', '$fee_paid', '$month', '$mode')";

                if ($result =  mysqli_query($con, $sql)) {

                    $response = array(
                        "success" => true,
                        "error" => ""
                    );
                } else {
                    $err = mysqli_error($con);
                }
            } 
            else {
                $err = "Receipt No. already exists";
            }
        } else {
            $err = mysqli_error($con);
        }
    } else {
        $err = "set key as -> `receipt_no`, `student_adm_no`, `amount`, `concession`, `fee_paid`, `months`, `mode` ";
    }
  
} else {
    $err = "Header should be POST";
}
sendPostRes($response, $err);
?>