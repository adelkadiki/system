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
<a href="mainpurch.php" class="btn btn-primary" id="purchbackto" style="margin-top:1%;">Pruchasement Main Page</a>
<div style="text-align:center; font-size:18px; font-weight:950;">COMPANY NAME</div>
          <div style="text-align:center; font-size:10px; font-weight:950;">Services we offer</div>
 
  <div id="printpart">
<div>Purchase Order number : <?php echo $id; ?> </div>
<div>To : <span style="font-weight: 950;" > <?php echo $vendor; ?> </span> </div>
<div> Date : <span style="font-weight: 950;"> <?php echo $date; ?> </span> </div>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Item number</th>
      <th scope="col">Product</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
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
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $product[$key]; ?></td>
      <td> <?php echo $unitprice[$key]; ?> </td>
      <td><?php echo $quantity[$key]; ?></td>
      <td><?php echo $subtotal; ?></td>
    </tr>
    <?php } ?>
    <tr style="background-color:#cdcecc; ">
    <td>TOTAL</td><td></td><td></td><td></td><td><?php echo $total; ?></td>
    </tr>
    
  </tbody>
</table>


<div style="font-size:12px;"> <span style="font-weight:950;">Address:</span> Street, Region, City</div>
<div style="font-size:12px;"><span style="font-weight:950;">Phone #:</span> 32656465</div>
<div style="font-weight:950; font-size:12px;">www.company.com</div>


<div class="col text-center">
<span style="width:75px;" class="btn btn-success" id="printpage" onclick="window.print()" >Print</span>
  </div>

</div>
     

<?php include("../template/footer.php");  ?>