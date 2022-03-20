
<?php
require_once('.././config.php');
require_once('.././function.php');
require_once('.././constant/constant.php');
$err = "";
$pass = "";
$token = "";
$device_type = "";
$callback = CALLBACK;
$Merchant_key = MERCHANT_KEY;
// $callback = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction";

if (isset(getallheaders()['Device-Type']))
    $device_type = getallheaders()['Device-Type'];

// $content_type = (getallheaders());


$response = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("./PaytmChecksum.php");
    header("Content-Type:application/json");
    $data = json_decode(file_get_contents('php://input'), true);
    // print_r($data);
    $file = fopen("requests.json", "a");
    fwrite($file, (file_get_contents('php://input') . "\n"));
    fclose($file);
    if (isset($data['order_id']) && isset($data['amount']) && isset($data['MID'])) {

        $mid = mysqli_real_escape_string($con, $data['MID']); //$_POST['MID'];
        $orderid = mysqli_real_escape_string($con, $data['order_id']); // $_POST['ORDER_ID'];
        $amount = mysqli_real_escape_string($con, $data['amount']); // $_POST['AMOUNT'];
        $student_id = mysqli_real_escape_string($con, $data['student_id']); // $_POST['AMOUNT'];

        // $callback = $callback."?mid=$mid&orderId=$orderid";

        $mid =   stripslashes($mid);
        $orderid =   stripslashes($orderid);
        $amount =   stripslashes($amount);
        $custId = $student_id;
        // add to db orderdetails
        //     if (mysqli_query($con, "INSERT INTO orders (order_id, user_id,token,amount ) values ('$orderid','$custId','$token','$amount')")) {
        // $resp = json_decode( it1());
        // $updateRes = updateResponse($con, it1(), $orderid);
        //         if ($updateRes["success"]) {
        //             $response = array(
        //                 "success" => true,
        //                 "data" => $updateRes["data"],
        //                 "resultInfo" => $updateRes["resultInfo"],
        //                 "error" => ""
        //             );
        //             $file = fopen("response.json", "a");
        //             fwrite($file, json_encode($response) . "\n");
        //         } else {
        //             $err = $updateRes["error"];
        //         }
        //     } else {
        //         // In case of any error
        //         $err = mysqli_error($con);
        //     }
        // } else {
        //     $err = $res["error"];
        // }
    } else {
        $err = "send all key correct";
    }
} else {
    $err = "Header should be POST";
}
$res = it(); //json_decode(it(), true);
// $re = updateResponse($con, $res, $orderid);
// if (!$re['success']) $res = $re['error'];
sendPostRes(array(
    "success" => true,
    "txnToken" => $res,
    // "txnToken" => $res['data']['body']['txnToken'],
    // "data" => $res['data'],
), $err);

function it1()
{
    return '{
    "data": {
      "head": {
        "responseTimestamp": "1624591680432",
        "version": "v1",
        "signature": "sKNlUTiT77l2tdfsqiY6XsFy9VQDQNkQ+CrMCJxHf5YLFn0hb+IUfai/spUWExfGVGFFWeFKFK00ZpUAMxE+mSrzSCF/beWSsrHyvhNuO3I="
      },
      "body": {
        "resultInfo": {
          "resultStatus": "S",
          "resultCode": "0000",
          "resultMsg": "Success"
        },
        "txnToken": "b817ef89a5984ee8be6333afed2777de1624591680295",
        "isPromoCodeValid": false,
        "authenticated": false
      }
    }
  }';
}

function updateResponse($con, $response, $orderid)
{
    global $callback;
    $data = $response; // json_decode($response, true);
    // $data = $data['data'];
    $res = array("success" => true, "data" => "");
    if (isset($data["head"]) && isset($data["body"])) {
        $head = $data['head'];
        $body = $data['body'];
        $info = $body["resultInfo"];
        $status = $info['resultStatus'];
        $code = $info['resultCode'];
        $msg = $info['resultMsg'];
        $res["resultInfo"] = $info;
        $sql = "UPDATE payment_info SET paytm_status = '{$status}', paytm_response_code = '{$code}', remarks='{$msg}'  where orderid = '{$orderid}'";
        if ($status == "S") {
            $signature = $head["signature"];
            $responseTimestamp = $head["responseTimestamp"];
            $txnToken = $body['txnToken'];
            $res["data"] = array("orderid" => $orderid, "txnToken" => $txnToken, "callback" => $callback);
            $sql = "UPDATE orders SET paytm_txnToken = '{$txnToken}', paytm_signature = '{$signature}' WHERE order_id = '{$orderid}'";
        }

        if (!mysqli_query($con, $sql)) {
            $res["success"] = false;
            $res["error"] = mysqli_error($con);
        }
    } else {
        $res["success"] = false;
        $res["error"] = "response not complete";
    }
    return $res;
}

function it()
{
    global $mid, $orderid, $amount, $custId, $Merchant_key, $callback;
    $paytmParams = array();

    $paytmParams["body"] = array(
        "requestType"   => "Payment",
        "mid"           => $mid,
        "websiteName"   => "WEBSTAGING",
        "orderId"       => $orderid,
        "callbackUrl"   => $callback,
        "txnAmount"     => array(
            "value"     => $amount,
            "currency"  => "INR",
        ),
        "userInfo"      => array(
            "custId"    => $custId,
        )
    );

    /*
    * Generate checksum by parameters we have in body
    * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
    */
    // $checksum = PaytmChecksum::getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $Merchant_key);

    // $paytmParams["head"] = array(
    //     "signature"    => $checksum
    // );
    $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

    /* for Staging */
    $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid='$mid'&orderId='$orderid'";
    return callAPI($url, $paytmParams);

    /* for Production */
    // $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$orderid";

    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    // $response = curl_exec($ch);
    // return ($response);
}

?>