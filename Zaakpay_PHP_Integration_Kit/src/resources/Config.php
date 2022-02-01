<?php

$merchantIdentifier = "51f17d6817a544fca84a7af49c1e47ff"; //Get your merchant identifier on Zaakpay.com
$secretKey = "6001ba50bd734358ae4de5ca5eae7735"; //Get your secret key on Zaakpay.com

$merchantIdentifier = "b19e8f103bce406cbd3476431b6b7973"; //Get your merchant identifier on Zaakpay.com
$secretKey = "0678056d96914a8583fb518caf42828a"; //Get your secret key on Zaakpay.com

//Api URL
$environment = "https://zaakstaging.zaakpay.com"; //For Live transaction use https://api.zaakpay.com
// $environment = "https://api.zaakpay.com";

//Payment processing URL's
$transactApi = "/api/paymentTransact/V8";

//Transaction update URL's
$updateApi = "/updatetransaction";

//Transaction check status URL's
$checkStatusApi = "/checkTxn?v=5";

//Url for test response file
$returnUrl = "http://localhost/projects/fee_collection/Zaakpay_PHP_Integration_Kit/src/com/zaakpay/api/Response.php"; //Change this with your response file
