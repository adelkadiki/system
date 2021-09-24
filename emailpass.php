<?php

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

$email = $_GET['email'];

$str = rand();
$hash = md5($str);
$domain = 'www.alertikaz.com';
$url = $domain.'/passwordresetlink.php?email='.$email.'&token='.$hash;
//echo $url;
//echo $hash;

date_default_timezone_set("Africa/Tripoli");

$expire = strtotime("+5 minutes");

$db = new Database();

    $stm = $db->connect()->prepare("INSERT INTO password_reset (email, token, expires)
    VALUES (:email, :token, :expires)");   

    $stm->bindValue(':email', $email);
    $stm->bindValue(':token', $hash);
    $stm->bindValue(':expires', $expire);
    $stm->execute();

    $msg = "Dear Customer, ";
    $msg .="Please click on the link to update your password";
    $msg .="<a href=".$url." > Click here </a>";

    mail($email, "Password reset", );

    echo 'email sent';

}else {

    header("location: login.php");
}

?>