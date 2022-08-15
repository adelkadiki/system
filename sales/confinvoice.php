<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php"); 

$url ="";
$invoiceId=0;
$current_file = basename($_SERVER['PHP_SELF']);
if($current_file=="confinvoice.php"){
$url .="salesmain.php";
}

if($_SERVER['REQUEST_METHOD']=='POST'){


        $product = $_POST['product'];
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['quantity'];
        $client = $_POST['client'];
        $sales_id = $_POST['salesid'];
       
        
        $db = new Database();
        
        foreach($product as $key => $v) { 

        
    
        $stm = $db->connect()->prepare("INSERT INTO invoice(product, unitprice, quantity, sales_id) 
        VALUES(:product, :unitprice, :quantity, :sales_id)");    
        $stm->bindValue(':product', $product[$key]);
        $stm->bindValue(':quantity', $quantity[$key]);
        $stm->bindValue(':unitprice', $unitprice[$key]);
        $stm->bindValue(':sales_id', $sales_id);
        $stm->execute();   

                  $stm2 = $db->connect()->prepare("UPDATE product set quantity=quantity-:quantity 
                  WHERE name=:name");    
                  $stm2->bindValue(':quantity', $quantity[$key]);
                  $stm2->bindValue(':name', $product[$key]);
                  $stm2->execute();     

        }

        $stms = $db->connect()->prepare("SELECT * FROM sales WHERE id=:id");    
        $stms->bindValue(':id', $sales_id);
        $stms->execute(); 

        while($row = $stms->fetch()){

              
        $invoiceId = $row['id'];

?>

<div class="container">
<a href="<?php echo $url; ?>"  class="btn btn-outline-primary" id="backtosales">صفحة المبيعات الرئيسية</a>
  <div style="text-align:center; font-size:20px; font-weight:950;">إسم الشركة</div>
          <div style="text-align:center; font-size:14px; font-weight:950;">الخدمات التى تقدمها الشركة</div>
  
  <div id="printpart">
<div class="rightwriting" > <?php echo $row['id']; ?> رقم الفاتورة </div>
<div class="rightwriting" > <span style="font-weight: 950;" > <?php echo $row['client']?> </span>  </div>
<div class="rightwriting" >  <span style="font-weight: 950;"> <?php echo $row['date'] ?> </span> التاريخ </div>

<?php } ?>
<table class="table table-striped">
  <thead style="background-color:#cdcecc;" id="tablehead">
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
  
  $subtotal=0;
  $total=0;
  $count=0;        

  foreach($product as $key => $v) { 
          
        $subtotal = $unitprice[$key]*$quantity[$key];
        $total = $total+$subtotal;

          ?>
    <tr>
      
      <td><?php echo $subtotal?> </td>
      <td><?php echo $quantity[$key]?></td>
      <td><?php echo $unitprice[$key]?></td>
      <td><?php echo $product[$key]?></td>
      <th scope="row"> <?php echo $count +=1; ?> </th>

    </tr>
  <?php } ?>
  <tr style="background-color:#cdcecc;  font-weight: 950;">
  <td><?php echo $total ?></td><td></td><td></td><td></td><td>الإجمالي</td>
  </tr>
  </tbody>
</table>

<div style="font-size:12px; text-align:right;"> <span style="font-weight:950;">العنوان</span> الشارع ، المنطقة ، المدينة</div>
<div style="font-size:12px; text-align:right;"><span style="font-weight:950;">التليفون</span> 32656465</div>
<div style="font-weight:950; font-size:12px; text-align:right;">www.company.com</div>

</div>

  <div class="col text-center">
<span style="width:75px;" class="btn btn-success" id="printpage" onclick="document.title=''+<?php echo $invoiceId ?>+''; window.print(); return false;" >طباعة</span>
  </div>

</div>
<?php 

  }

include("../template/footer.php"); 
?>