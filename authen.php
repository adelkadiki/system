<?php
//session_start();
require_once("model/db.class.php");
require_once("model/user.class.php");

$user = new User();
$db = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){

$username = $_POST['username'];
$password = $_POST['password'];

$auth = false;



   $res = $user->login($username, $password);

    if($res){

        $auth = true;
        
    }
    
   
    echo $auth;

}



?>
