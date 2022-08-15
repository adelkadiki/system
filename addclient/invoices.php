<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include_once("../model/db.class.php");
include("../template/header.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

  $client_id = $_GET['id'];
  $company = $_GET['company'];

  
  $_SESSION['client_id'] = $client_id;
  $_SESSION['company'] = $company;
  
  $db = new Database();
    
  $stm = $db->connect()->prepare("SELECT * FROM sales WHERE client_id=:id");     
  $stm->bindValue(':id', $client_id);
  $stm->execute();   

  if($stm->rowCount() == 0){

      echo '<a href="allclients.php" class="btn btn-outline-primary" style="margin-top:3%; margin-left:7%;" > قائمة العملاء </a>';
      echo '<h3 style="text-align:center;" > لا يوجد فواتير لهذا الزبون </h3>';
  } else {

      
 ?>


<div class="container">

<a class="btn btn-outline-primary" style="margin-top:1%;" href="allclients.php">قائمة العملاء</a>


<h3 style="text-align:center;">  <span><?php echo $company; ?></span> قائمة الفواير الخاصة بـ  </h3>


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
      <td><a href="../sales/invdetails.php?id=<?php echo $row['id'];?>">الفاتورة</a></td>

    </tr>

  <?php } 
  }
  ?>
  </tbody>

</table>


  </div>


 <?php     
    
}


?>





<?php include("../template/footer.php");?>