<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include("../template/header.php"); 
require_once("../model/db.class.php");

$db = new Database();

$stm = $db->connect()->prepare("SELECT * FROM purchasement");
$stm->execute();

?>

<div class="container" style="padding-top:3%;">

<h3 class="maintext" >قائمة المشتريات</h3>

<a href="mainpurch.php" > <button  style="margin-bottom:30px;" class="btn btn-outline-primary">صفحة المشتريات الرئيسية</button></a>

<table class="table table-striped" id="allpurches">
  <thead>
    <tr>
      <th scope="col">رقم الطلبية</th>
      <th scope="col">الشركة</th>
      <th scope="col">المجموع</th>
      <th scope="col">التاريخ</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php while($row=$stm->fetch()){ ?>
    <tr>
      <th scope="row"> <?php echo $row['id']; ?> </th>
      <td><?php echo $row['vendor']; ?></td>
      <td> <?php echo $row['totalprice']; ?> </td>
      <td> <?php echo $row['date']; ?> </td>
      
      <td><?php echo '<a class="btn btn-outline-info" href="purchdetails.php?id='.$row['id'].'">التفاصيل</a>' ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<br><br>

</div>

<?php include("../template/footer.php"); ?>