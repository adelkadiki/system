<?php

require_once("model/db.class.php");
require_once("model/user.class.php");

$user = new User();
$db = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){

$username = $_POST['username'];
$password = $_POST['password'];

    $res = $user->login($username, $password);

    if($res){

        header("location: cp.php");
        
    }else{
        
        $error = 'Incorrect username or password';
        session_start();
        $_SESSION['error'] = $error;
        header("location: index.php");
    }


}



?>
