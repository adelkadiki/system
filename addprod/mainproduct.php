<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include_once("../model/db.class.php");
include("../template/header.php");
?>

<div class="container">



<div class="container" style="padding-top:10%;">

<div class="row">
<div class="col text-center">
<a href="addprod.php" > <button class="btn btn-primary salespage" id="addnewproduct">إضافة بيانات سلعة</button> </a>

</div>
</div>

<div class="row">
<div class="col text-center">

<a href="productslist.php" >  <button class="btn btn-success salespage" id="productslistbtn" >قائمة السلع</button> </a>
</div>
</div>

</div>




</div>



<?php include("../template/footer.php");?>