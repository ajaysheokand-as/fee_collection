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
    if (isset($data['class']) && isset($data['title']) && isset($data['amount']) && isset($data['fund_type']) ) {
        $class = $data['class'];
        $title = $data['title'];
        $amount = $data['amount'];
        $fund_type = $data['fund_type'];
        // $category =  filter_var($data['category'], FILTER_SANITIZE_STRING);
         $query = "SELECT class, title, amount, fund_type FROM `fee_structure` where class = '$class' and title = '$title' and amount = '$amount' and fund_type = '$fund_type' ";
        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) < 1) {
                $sql = "INSERT INTO `fee_structure`(`class`, `title`, `amount`, `fund_type`) VALUES  ('$class','$title','$amount','$fund_type')";

                if ($result =  mysqli_query($con, $sql)) {

                    $response = array(
                        "success" => true,
                        "error" => ""
                    );
                } else {
                    $err = mysqli_error($con);
                }
            } else {
                $err = "Already Exists";
            }
        } else {
            $err = mysqli_error($con);
        }
    } else {
        $err = "set key as -> `class` `title` and `amount` ";
    }
  
} else {
    $err = "Header should be POST";
}
sendPostRes($response, $err);
?>
