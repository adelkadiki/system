<?php


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php"); 

$id = $_SESSION['user_id'];

$username='';
$email = '';

$db = new Database();

$stm = $db->connect()->prepare("SELECT * FROM user WHERE id=:id");
$stm->bindValue(':id', $id);
$stm->execute();

while($row = $stm->fetch()){

        $username .= $row['username'];
        $email .= $row['email'];
}

?>

<div class="container" style="padding-top:3%;">

<div> Username : <span><?php echo $username?></span></div>
<div> Email : <span><?php echo $email?></span></div>


<div class="row">
<div class="col text-center">
<a href="email.php" > <button class="btn btn-primary salespage" id="newinvbtn">Reset email</button> </a>

</div>
</div>

<div class="row">
<div class="col text-center">

<a href="sales.php" >  <button class="btn btn-success salespage" id="saleslistbtn" >Reset password</button> </a>
</div>
</div>


</div>


<?php include("../template/footer.php");  ?>