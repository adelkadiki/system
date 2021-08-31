<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

    $db = new Database();
    
    $stm = $db->connect()->prepare("SELECT * FROM product");
    $stm->execute();
?>


<div class="container" style="padding-top:3%;">

<h3 class="maintext" >قائمة السلع</h3>

<a href="mainproduct.php" > <button  style="margin-bottom:30px;" class="btn btn-outline-primary">صفحة البضائع</button></a>

<table class="table table-striped" id="allpurches">
  <thead>
    <tr>
      <th scope="col">الرمز</th>
      <th scope="col">الإسم</th>
      <th scope="col">الوصف</th>
      
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php while($row=$stm->fetch()){ ?>
    <tr>
      <th scope="row"> <?php echo $row['id']; ?> </th>
      <td><?php echo $row['name']; ?></td>
      <td> <?php echo $row['description']; ?> </td>
      
      
      <td><?php echo '<a class="btn btn-outline-info" href="productdetails.php?id='.$row['id'].'">تفاصيل</a>' ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

</div>

<?php include("../template/footer.php"); ?>