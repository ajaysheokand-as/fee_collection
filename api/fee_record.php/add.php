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
    if (isset($data['student_name']) && isset($data['student_father_name']) && isset($data['student_admissiion_no']) && isset($data['student_gender']) && isset($data['student_class_id']) && isset($data['student_address']) && isset($data['student_mobile']) ) {
        $student_name = $data['student_name'];
        $student_father_name = $data['student_father_name'];
        $student_admissiion_no = $data['student_admissiion_no'];
        $student_gender = $data['student_gender'];
        $student_class_id = $data['student_class_id'];
        $student_address = $data['student_address'];
        $student_mobile = $data['student_mobile'];
        // $category =  filter_var($data['category'], FILTER_SANITIZE_STRING);
        // if ($result = mysqli_query($con, "SELECT cat_name FROM `category` where cat_name = '$category' and restaurant = $restaurant")) {
        //     if (mysqli_num_rows($result) < 1) {
                $sql = "INSERT INTO `fee_structure`(`structure_id`, `class`, `title`, `amount`, `status`, `remark`, `date`) VALUES ($student_id)";

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