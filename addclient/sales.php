<?php 


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

        include("../template/header.php"); 
        require_once("../model/db.class.php");

?>

<div class="container" style="padding-top:10%;">


        <div class="row">
        <div class="col text-center" >
        <a href="addclient.php" > <button class="btn btn-success salespage" id="newClientBtn" >إضافة بيانات زبون</button> </a>
        </div>
        </div>    
  
        <div class="row">
        <div class="col text-center">
        <a href="allclients.php" > <button class="btn btn-primary salespage" id="allClientsBtn" >قائمة الزبائن</button> </a>
        </div>
        </div>
        
          
</div>