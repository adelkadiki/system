<?php
//session_start();
include("../template/header.php"); 
include_once("../model/db.class.php");



if($_SERVER['REQUEST_METHOD']=='POST'){

     $product= $_POST['product'];
     $quantity= $_POST['quantity'];
     $unitprice= $_POST['unitprice'];
     $id = $_POST['purchid'];
     
// $id = $_SESSION['id'];
//echo 'The id is '.$id.'<br>';
     
$vendor ="";
$date ="";
$db = new Database();

     foreach($product as $key => $v) {


        try{

            $stmpd = $db->connect()->prepare("INSERT INTO purchdetails(product, quantity, unitprice, purch_id)
                VALUES(:product, :quantity, :unitprice, :purch_id)");
                
                $stmpd->bindValue(':product', $product[$key]);
                $stmpd->bindValue(':quantity', $quantity[$key]);
                $stmpd->bindValue(':unitprice', $unitprice[$key]);
                $stmpd->bindValue(':purch_id', $id);
                $stmpd->execute();
        
      }catch(PDOException $e){
                echo $e->getMessage();
                }

     }

     
}

     $stm = $db->connect()->prepare("SELECT * FROM purchasement WHERE id=:id");
                
                $stm->bindValue(':id', $id);
                $stm->execute();
        
                while($row = $stm->fetch()){

                    $vendor .=  $row['vendor'];
                    $date .=  $row['date'];
                }

?>

<div class="container">
<a class="btn btn-outline-primary" id="backbtn" href="allpurchs.php">قائمة المشتريات</a>
<span style="width:75px; margin-top:3%; margin-left:65%;" class="btn btn-success" id="printpage" onclick="window.print()" >طباعة</span>
<div style="text-align:center; font-size:38px; font-weight:950;">إسم الشركة</div>
<div style="text-align:center; font-size:25px; font-weight:950;">الخدمات التي نقدمها</div>

<div style="text-align:center; text-decoration: underline; font-size:25px; font-weight:950; margin-top: 7px;" >طلبية شراء</div>        

 
  <div id="printpart">
<div class="rightwriting" >رقم الطلبية <?php echo $id; ?> </div>
<div class="rightwriting">الشركة <span style="font-weight: 950;" > <?php echo $vendor; ?> </span> </div>
<div class="rightwriting" > التاريخ <span style="font-weight: 950;"> <?php echo $date; ?> </span> </div>

<table class="table table-striped">
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
    $subtotal=0;
    $total=0;

    foreach($product as $key => $v) { 
         $count +=1;
         $subtotal = $unitprice[$key]*$quantity[$key];
         $total = $total+$subtotal;
         ?>
    <tr>
      <td><?php echo $subtotal; ?></td>
      <td><?php echo $quantity[$key]; ?></td>
      <td> <?php echo $unitprice[$key]; ?> </td>
      <td><?php echo $product[$key]; ?></td>
      <th scope="row"><?php echo $count; ?></th>

    </tr>
    <?php } ?>
    <tr style="background-color:#cdcecc; ">
    <td><?php echo $total; ?></td><td></td><td></td><td></td><td>  الإجمالي </td>
    </tr>
    
  </tbody>
</table>

<div  class="rightwriting invdet"> <span style="font-weight:950;">العنوان</span> المبني الشارع المنطقة</div>
<div  class="rightwriting invdet"><span style="font-weight:950;">هاتف</span> 32656465</div>
<div style="font-weight:950; font-size:18px;" class="rightwriting">www.company.com</div>
<!-- 
<div class="col text-center">
<span style="width:75px;" class="btn btn-success" id="printpage" onclick="window.print()" >Print</span>
  </div> -->

</div>
     

<?php include("../template/footer.php");  ?>