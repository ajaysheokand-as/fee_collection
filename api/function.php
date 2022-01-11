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


