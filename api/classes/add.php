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
    if (isset($data['class_section']) && isset($data['class_section']) ) {
        $class_title = $data['class_title'];
        $class_section = $data['class_section'];
        // $category =  filter_var($data['category'], FILTER_SANITIZE_STRING);
        // if ($result = mysqli_query($con, "SELECT cat_name FROM `category` where cat_name = '$category' and restaurant = $restaurant")) {
        //     if (mysqli_num_rows($result) < 1) {
                $sql = "INSERT INTO `class`(`class_title`, `class_section`) VALUES('$class_title', '$class_section')";

                if ($result =  mysqli_query($con, $sql)) {

                    $response = array(
                        "success" => true,
                        "error" => ""
                    );
                } else {
                    $err = mysqli_error($con);
                }
        //     } else {
        //         $err = "Category already exists";
        //     }
        // } else {
        //     $err = mysqli_error($con);
        // }
    } else {
        $err = "set key as -> `class_title` and `class_section` ";
    }
  
} else {
    $err = "Header should be POST";
}
sendPostRes($response, $err);
?>