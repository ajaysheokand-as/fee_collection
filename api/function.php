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

$today = date('Y-m-d');
function cal_month($adm_date = '2021-03-01', $current_date = 0)
{
    if ($current_date == 0)
        $current_date = $GLOBALS['today'];
    $ts1 = strtotime($adm_date);
    $ts2 = strtotime($current_date);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $total_month = (($year2 - $year1) * 12) + ($month2 - $month1);
    return ($total_month);
    // echo $diff;
}

function month_name($start_date = '2021-03-01')
{

    $ts1 = strtotime($start_date);

    $month1 = date('m', $ts1);

    return date("F", mktime(0, 0, 0, $month1, 10));
}
