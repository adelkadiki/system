<?php 

 session_start();
if(!isset($_SESSION['user_id'])){
   die(header("location: ../index.php"));
}


include("../template/header.php"); 

?>

<div class="container" style="padding-top:10%;">

<div class="row">
<div class="col text-center">
<a href="invoice.php" > <button class="btn btn-primary salespage" id="newinvbtn">إصدار فاتورة</button> </a>

</div>
</div>

<div class="row">
<div class="col text-center">

<a href="sales.php" >  <button class="btn btn-success salespage" id="saleslistbtn" >قائمة المبيعات</button> </a>
</div>
</div>

</div>



<?php 

include("../template/footer.php"); 



?>