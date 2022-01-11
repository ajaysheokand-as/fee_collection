<?php 
include('config.php');

$student_id =1;
$class_id = 1;
 
$query = "SELECT SUM(amount) as amount FROM fee_structure where class = $class_id or class = 'Common' ";
$res = mysqli_query($con, $query);
echo mysqli_fetch_assoc($res)['amount'];


?>