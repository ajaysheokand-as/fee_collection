<?php
//function  send response in post method
function sendPostRes($data, $error)
{
    if ($error != "") {
        $error = array(
            'success' => false,
            'error' => $error
        );
        echo json_encode($error);

        return;
    }

    echo json_encode($data);
}
function genrate_token(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function check_token($con, $token)
{
    $sql = "SELECT * FROM `logined_user` where token = '{$token}'";
    $res = array("success" => true);
    if ($result = mysqli_query($con, $sql)) {

        if ($result->num_rows > 0) {
            return $res;
        }
    }
    $res["success"] = false;
    $res["error"] = "check token: " . mysqli_error($con);
    return $res;
}
function add_new_token($con, $token, $user_id, $device_id, $device_type)
{
    $sql = "INSERT INTO `logined_user` (`token`,`user_id`, `device`, `platform`)  values ('{$token}','{$user_id}','{$device_id}','{$device_type}')";
    if (mysqli_query($con, $sql)) {
        return true;
    }
    return "error in adding token: " . mysqli_error($con);
}
function get_user_id($con, $token)
{
    $sql = "SELECT user_id FROM `logined_user` where token = '{$token}'";
    $res = array("success" => true);
    if ($result = mysqli_query($con, $sql)) {

        if ($result->num_rows > 0) {
            $res["user_id"] = mysqli_fetch_assoc($result)["user_id"];
            return $res;
        } else {
            $res["success"] = false;
            $res["error"] = "No Data Found with token: " . $token;
            return $res;
        }
    }
    $res["success"] = false;
    $res["error"] = mysqli_error($con);
    return $res;
}
