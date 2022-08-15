<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

$page = $_SESSION['page'];


$client_id = $_SESSION['client_id'];
$company = $_SESSION['company'];

include_once("../model/db.class.php");
include("../template/header.php"); 

$id= $_GET['id'];

$updatelink = 'updatesales.php?id='.$id;

$db = new Database();

$stm = $db->connect()->prepare("SELECT * FROM invoice WHERE sales_id=:id");   
$stm->bindValue(':id', $id);
$stm->execute();


$stms = $db->connect()->prepare("SELECT * FROM sales WHERE id=:id");   
$stms->bindValue(':id', $id);
$stms->execute();

    while($row = $stms->fetch()){ ?>

<div class="container">

<?php 
      if($page == 'allclients.php'){
      
        $url = '../addclient/invoices.php?id='.$client_id.'&company='.$company ;
        echo '<a href="'.$url.'" class="btn btn-outline-primary" id="backto">قائمة الفواتير</a>';  
      
      }else if($page == 'sales.php'){
        
        $url = 'sales.php';
        echo '<a href="'.$url.'" class="btn btn-outline-primary" id="backto">قائمة المبيعات</a>';  
      
      }
?>
<!-- <a href="sales.php" class="btn btn-outline-primary" id="backto">قائمة المبيعات</a>   -->
<span style="width:75px; margin-top:3%; margin-left:65%;" class="btn btn-success" id="printpage" onclick="document.title=''+<?php echo $id ?>+''; window.print(); return false;" >طباعة</span>

<div style="text-align:center; font-size:38px; font-weight:950;">إسم الشركة</div>
<div style="text-align:center; font-size:25px; font-weight:950;">الخدمات التي نقدمها</div>

<div style="text-align:center; text-decoration: underline; font-size:25px; font-weight:950; margin-top: 7px;" >فاتورة</div>        

<div class="rightwriting invdet"> <?php echo $row['id']?> رقم الفاتورة  </div>
<div class="rightwriting invdet" > <span style="font-weight: 950;" > <?php echo $row['client']?> </span> </div>
<div class="rightwriting invdet" > التاريخ <span style="font-weight: 950;"> <?php echo $row['date'] ?> </span> </div>

<?php }

    // echo $product.'<br>';
    // echo $quantity.'<br>';
    // echo $unitprice.'<br>';
   

?>

<div class="container">

<table class="table table-striped" id="invdetTable">
  <thead>
    <tr>
      <th scope="col">المجموع</th>
      <th scope="col">الكمية</th>
      <th scope="col">سعر الوحدة</th>
      <th scope="col">الوصف</th>
      <th scope="col">#</th>
      
    </tr>
  </thead>
  <tbody>
     
  <?php 
  $count=0;
  $total=0;
  $subtotal=0;
  while($row = $stm->fetch()){ 
    
    $subtotal = $row['unitprice']*$row['quantity'];

      ?>
    <tr>
      <th><?php echo $subtotal; ?> </th>
      <td><?php echo $row['quantity'];?></td>
      <td><?php echo $row['unitprice'];?></td>
      <td><?php echo $row['product'];?></td>
      <td><?php echo $count+=1;?></td>
      
    </tr>
<?php 
    $total = $total + $subtotal;
} ?>    
    <tr style="font-weight: 950;">
        <td style="font-size:20px;"><?php echo $total; ?></td><td></td><td></td><td></td><td>الإجمالي</td>
    </tr>
  </tbody>
</table>

</div>

<div  class="rightwriting invdet"> <span style="font-weight:950;">العنوان</span> المبني الشارع المنطقة</div>
<div  class="rightwriting invdet"><span style="font-weight:950;">هاتف</span> 32656465</div>
<div style="font-weight:950; font-size:18px;" class="rightwriting">www.company.com</div>


<!-- <div class="col text-center">
<span style="width:75px;" class="btn btn-success" id="printpage" onclick="window.print()" >طباعة</span><br><br>

  </div> -->

  <div class="col text-center">
<a style="width:75px; margin-top:2%;" class="btn btn-warning" id="updatesales" href="<?php echo $updatelink;?>" >تعديل</a><br><br>
  </div>



</div>

<?php include("../template/footer.php"); ?>