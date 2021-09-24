<?php 

 session_start();
 if(!isset($_SESSION['user_id'])){
    die(header("location: ../index.php"));
 }
        include("../template/header.php"); 
        require_once("../model/db.class.php");
?>


<div class="container" style="padding-top:10%;">



<!-- 
<div class="row">
<div class="col text-center">
<a href="../addvendor/addvend.php"><button class="btn btn-success"  id="newvenbtn">إضافة بيانات مورّد</button></a>
<a href="../addprod/addprod.php"><button class="btn btn-warning" id="newprodbtn">إضافة بيانات سلعة</button></a>
</div>
</div>

<div class="row">
<div class="col text-center">
<a href="newpurch.php"><button class="btn btn-pirmary" id="newpurchbtn">إضافة بيانات مشتريات</button></a>
<a href="allpurchs.php"><button class="btn btn-warning" id="allpurchbtn">قائمة المشريات</button></a>
</div>
</div>
 -->

 <div class="row">
<div class="col text-center">
<a href="newpurchase.php" > <button class="btn btn-primary salespage" id="newinvbtn">إضافة طلبية شراء</button> </a>

</div>
</div>

<div class="row">
<div class="col text-center">

<a href="allpurchs.php" >  <button class="btn btn-success salespage" id="saleslistbtn" >قائمة المشريات</button> </a>
</div>
</div>



</div>