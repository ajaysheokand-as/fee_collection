<?php
/*
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("PaytmChecksum.php");
define("MERCHANT_ID", "OgdBig44888892307561");
define("MERCHANT_KEY", "rwYI3!F8pHsue%sQ");
define("CALLBACK_URL", "");
$paytmParams = array();
$oid = "od001212";
$paytmParams["body"] = array(
    "mid"           => MERCHANT_ID,
    "requestType"   => "Payment",
    "websiteName"   => "WEBSTAGING",
    "orderId"       => $oid,
    "callbackUrl"   => "https://<callback URL to be used by merchant>",
    "txnAmount"     => array(
        "value"     => "10.00",
        "currency"  => "INR",
    ),
    "userInfo"      => array(
        "custId"    => "CUST_001",
    ),
);

/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), MERCHANT_KEY);

$paytmParams["head"] = array(
    "signature"    => $checksum
);

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=" . MERCHANT_ID . "&orderId=" . $oid;

/* for Production */
// $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
$response = curl_exec($ch);
print_r($response);
