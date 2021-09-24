<?php 


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include("../template/header.php"); 
?>

<div class="container" style="padding-top:10%; padding-left:10%;">


<div class="row">
    
        <div class="col text-center" >
        <a href="salesandpurch.php"> <button class="btn btn-success salespage"  id="newVendortBtn" >إجمالي البيع و الشراء</button> </a>
        </div>
        </div>    
  
        <div class="row">
        <div class="col text-center">
        <a href="annualsales.php" > <button class="btn btn-primary salespage" id="allVendorsBtn" >قائمة المبيعات الشهرية</button> </a>
        </div>
        </div>


        <div class="row">
        <div class="col text-center">
        <a href="annualpurch.php" > <button class="btn btn-primary salespage" id="allVendorsBtn" >قائمة المشتريات الشهرية</button> </a>
        </div>
        </div>
    
</div>


<?php 
include("../template/footer.php"); 
?>
