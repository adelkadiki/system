<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include("../template/header.php"); 
require_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];
    
    $db = new Database();
    
    $stm = $db->connect()->prepare("SELECT * FROM purchasement WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();

    


?>

<div class="container" style="padding-top:2%;">

<a class="btn btn-outline-primary" id="backbtn" href="allpurchs.php">قائمة المشتريات</a>
<span style="width:75px; margin-top:3%; margin-left:65%;" class="btn btn-success" id="printpage" onclick="window.print()" >طباعة</span>
<div style="text-align:center; font-size:23px; font-weight:950;">إسم الشركة</div>
<div style="text-align:center; font-size:15px; font-weight:950;">الخدمات التي نقدمها</div>

<div style="text-align:center; text-decoration: underline; font-size:20px; font-weight:950; margin-top: 7px;" >طلبية شراء</div>        

<?php while($row=$stm->fetch()){ ?>

<div class="rightwriting" >رقم الطلبية <?php echo $row['id']; ?></div> 
<div class="rightwriting">التاريخ <?php echo $row['date']; ?></div> <br>
<h5 class="rightwriting"> <?php echo $row['vendor']; ?> </h5>



<table class="table table-striped">
  <thead>
    <tr>
      <th>الإجمالي</th>
      <th scope="col">سعر الوحدة</th>
      <th scope="col">الكمية</th>
      <th scope="col">الوصف</th>
      <th scope="col">#</th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
    
    $count=0;
     $oldQnt = array();
    
    

    $stmpd = $db->connect()->prepare("SELECT * FROM purchdetails WHERE purch_id=:purch_id");
    $stmpd->bindValue(':purch_id', $id);
    $stmpd->execute();
    
    while($rowpd=$stmpd->fetch()){ 
      
          

          $oldQnt[$rowpd['product']] = $rowpd['quantity'];
      ?>

            
    <tr>
      <td> <?php echo $rowpd['quantity']*$rowpd['unitprice']; ?> </td>
      <td> <?php echo $rowpd['unitprice']; ?> </td>
      <td> <?php echo $rowpd['quantity']; ?> </td>
      <td> <?php echo $rowpd['product']; ?> </td>
      <th scope="row"> <?php echo $count+=1; ?> </th>
 </tr>
    <?php 
          
          
  } ?>
    <tr style="background-color:#cdcecc; font-weight:950;">
   <td> <?php echo $row['totalprice']; ?></td><td></td> <td></td> <td></td> <td> الإجمالي </td>
    </tr>
    <?php } 
    

    ?>
  </tbody>
</table>



<form action="editpurch.php" method="post">

<input name="id" type="hidden" value="<?php echo $id; ?>">

       <input type="hidden" name="jsonQnt"  value="<?php echo base64_encode(serialize($oldQnt)); ?>" > 

<div class="col text-center">
<button class="btn btn-warning" id="editpurch">تعديل</button>
</div>

</form>
<?php } ?>


</div>


