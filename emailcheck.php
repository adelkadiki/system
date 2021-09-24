<?php

require_once("model/db.class.php");
require_once("model/user.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $email = $_POST['email'];
    $res = false;

     $user = new User();
     $verf = $user->emailVerf($email);

     if($verf){
            $res = true;
     }

     echo $res;

    }else {

        header("location: login.php") ;

    }

    

?>