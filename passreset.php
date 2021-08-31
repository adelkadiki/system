<?php

require("model/db.class.php");


if($_SERVER['REQUEST_METHOD']=='GET'){


    $email = $_GET['email'];
   
    $selector = bin2hex(random_bytes(8));
    $pretoken = random_bytes(32);
    $token = bin2hex($pretoken);
    $hashed = password_hash($token, PASSWORD_DEFAULT);

    $domain = 'system.com/'
    
    $url = $domain.'new-password.php?selector='.$selector.'&validator='.$token;

    $expires = date("U") + 1800;

    $db = new Database();
$stm= $db->connect()->prepare("DELETE FROM password_reset WHERE email=:email");
$stm->bindValue(':email', $email);
$stm->execute();

$stmpass = $db->connect()->prepare("INSERT INTO password_reset(email, selector, token, expires) VALUES(:email, :selector, :token, :expires)");
$stmpass->bindValue(':email', $email);
$stmpass->bindValue(':selector', $selector);
$stmpass->bindValue(':token', $hashed);
$stmpass->bindValue(':email', $email);
$stm->execute();

$message = '<a href="'.$url.'">Password reset link</a>';

$headers = "From: System <info@system.ly>\n";
$headers .="Content-type: text/html\n";

mail($email, "Password reset", $message, $headers);

header("Location: index.php");

}

?>