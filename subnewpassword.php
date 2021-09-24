<?php 

// require_once("model/db.class.php");


// if($_SERVER['REQUEST_METHOD']=='POST'){


//     $selector = $_POST['selector'];
//     $validator = $_POST['validator'];
//     $password = $_POST['password'];

    


// }

// $stamp = mktime(0,0,0,9,4,2021);
// echo $stamp.'<br>' ;

// $stamp2 = mktime(0,0,0,date('m'), date('d'), date('Y'));
// echo $stamp2;

date_default_timezone_set("Africa/Tripoli");
$date1 = strtotime("now");
echo $date1.'<br>';
$date2 = strtotime("+5 minutes");
echo $date2.'<br>';
$diff = $date2-$date1;
echo $diff.'<br>';
echo '///////////<br>';


?>