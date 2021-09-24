<?php

$userid= $_GET['userid'];
$email = $_GET['email'];

// echo $userid.'<br>';
// echo $email.'<br>';

$id = base64_decode($userid);
$e = base64_decode($email);

echo $id.'<br>';
echo $e.'<br>';

?>