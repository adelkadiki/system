<?php
include_once("../model/db.class.php");
include("../template/header.php");



if($_SERVER['REQUEST_METHOD']=='POST'){

    $client= $_POST['client'];
    $quantity = $_POST['quantity'];
    $unitprice = $_POST['unitprice'];
    $product = $_POST['product'];
    $date = $_POST['date'];
    
   // $client="";

  //  echo $client.'<br>';
  //  echo $quantity.'<br>';
  //  echo $unitprice.'<br>';
  //  echo $product.'<br>';
  //  echo $date.'<br>';
   
        
      //  $db = new Database();
    
      //   $stmc = $db->connect()->prepare("INSERT INTO sales(client, payment)");    
      //  $stmc->bindValue(':id', $client_id);
        // $stmc->execute();

        // while($row = $stmc->fetch()){

        //     $client .= $row['company'];
        // }
    

   

    $count=0;
    $subtotal=0;
    $total=0;

    ?>
<div class="container">

 <h3 class="maintext">Invoice Details</h3>

<table class="table table-striped">
  <thead>
    <tr style="background-color:#cdcecc; font-weight:bold;" >
      <th scope="col">Item Number</th>
      <th scope="col">Product</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php  foreach($product as $key => $v) { 
    
    $subtotal= $unitprice[$key]*$quantity[$key];
    $total = $total+$subtotal;
    ?>
    <tr>
    
      <th scope="row"><?php echo $count +=1;?></th>
      <td><?php echo $product[$key]?></td>
      <td><?php echo $unitprice[$key]?></td>
      <td><?php echo $quantity[$key]?></td>
      <td><?php echo $subtotal ?></td>
      
    </tr>

    <?php } ?>
    <tr style="background-color:#cdcecc;  font-weight:bold;" >
      <td>TOTAL</td> <td></td> <td></td> <td></td><td><?php echo $total; ?></td>
    </tr>
  </tbody>
</table>

</div>
    <?php    
        
        $db = new Database();
    
        $stmc = $db->connect()->prepare("INSERT INTO sales(client, payment, date, client_id) VALUES(:client, :payment, :date, :client_id)");    
        $stmc->bindValue(':client', $client);
        $stmc->bindValue(':payment', $total);
        $stmc->bindValue(':date', $date);
        $stmc->bindValue(':client_id', 0);
        $stmc->execute();
        
        ?>
        
        

          <form action="confinvoice.php" method="post">

          <?php foreach($product as $key => $v){  ?>

          <input type="hidden" value="<?php echo $product[$key]; ?>" name="product[]" >
          
          <input type="hidden" value="<?php echo $unitprice[$key]; ?>" name="unitprice[]" >

          <input type="hidden" value="<?php echo $quantity[$key]; ?>" name="quantity[]" >

          <input type="hidden" value="<?php echo $sales_id ; ?>" name="salesid" >
          
          <input type="hidden" value="<?php echo $client; ?>" name="client" ><br>

          <?php }   ?>

          <button class="btn btn-success" >Confirm</button>
          </form>

            <form action="delsales.php" method="get">
            <input type="hidden" value="<?php echo $sales_id?>" name="id">
            <button class="btn btn-warning">Cancel</button>
            </form>
     
<?php
}
?>

<?php include("../template/header.php");?>