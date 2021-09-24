<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include("../template/header.php"); 

include_once("../model/db.class.php");

$db = new Database();
$stm= $db->connect()->prepare("SELECT * FROM client");
$stm->execute();

$file = basename(__FILE__);
session_start();
$_SESSION['page'] = $file;

?>



<div class="container">

<h3 style="text-align:center; margin-top:3%;">قائمة العملاء</h3>
<a class="btn btn-outline-primary" href="sales.php">صفحة الزبائن الرئيسية</a><br><br>

<div class="form-group">
    
    <!-- <input type="text" class="form-control" placeholder="Search" id="clientsearch"> -->
    
  </div>

<table class="table table-striped" id="clienttable">
  <thead>
    <tr>
      <th scope="col">الشركة</th>
      <th scope="col">المدير</th>
      <th scope="col">الهاتف</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $stm->fetch()) { 
    
      $id = $row['id'];
      $company = $row['company'];
      $url = 'invoices.php?id='.$id.'&company='.$company;

    ?>  
    <tr>  
    
      <td><?php echo $row['company'] ?></td>
      <td><?php echo $row['manager'] ?></td>
      
      <td><?php echo $row['phone'] ?></td>
      
      <td> <form action="clientdetails.php" >
      <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
     <button class="btn btn-outline-secondary" type="submit">تفاصيل</button>
      </form> </td>
      <td><a href="<?php echo $url?>" class="btn btn-outline-info">فواتير</a></td>
    </tr>
    <?php } ?>   
  </tbody>
 
</table> <br><br>

</div>

<?php include("../template/footer.php"); ?>