<?php 
session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include_once("../model/db.class.php");
include("../template/header.php"); 


$file = basename(__FILE__);
$_SESSION['page'] = $file;


$db = new Database();

$stm = $db->connect()->prepare("SELECT * FROM sales");   
$stm->execute();


?>

<div class="container">

<a class="btn btn-outline-primary" style="margin-top:1%;" href="salesmain.php">صفحة المبيعات الرئيسية</a>

<h3 style="text-align:center;">قائمة المبيعات</h3>

<div class="form-group">
    
    <!-- <input type="text" class="form-control" placeholder="Search" id="salesearch"> -->
    
  </div>

<table class="table table-striped" id="salestable">
  <thead>
    <tr>
    <th scope="col">رقم الفاتورة</th>
      <th scope="col">الزبون</th>
      <th scope="col">القيمة</th>
      <th scope="col">التاريخ</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $stm->fetch()){ ?>  
  <tr>
      <td> <?php echo $row['id']; ?> </td>
      <td> <?php echo $row['client']; ?> </td>
      <td><?php echo $row['payment']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><a class="btn btn-outline-info" href="invdetails.php?id=<?php echo $row['id'];?>">الفاتورة</a></td>

    </tr>
   <?php } ?>
  </tbody>
</table>
<br><br>

  </div>




<?php include("../template/footer.php"); ?>