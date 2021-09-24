<?php



// include_once("../model/db.class.php");
// include("../template/header.php"); 

$url = 'system.com/';

$userid = $_GET['userid'];
$email = $_GET['email'];


$encodedid = base64_encode($userid);
$encodedemail = base64_encode($email);



 $link = $url.'/user/userinfo.php?id='.$encodedemail.'&email='.$encodedemail;

 echo $link;





?>