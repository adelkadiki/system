<?php
include_once("../model/db.class.php");
include("../template/header.php");

//session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $product = $_POST['vendor'];
    $quantity = $_POST['quantity'];
    $unitprice = $_POST['unitprice'];
    $date = $_POST['date'];
    $vendorid = $_POST['vendorid'];
    $vendor="";
    
   //  echo 'Date = '.$_POST['date'].'<br>';
    
        
 
    $db = new Database();

    try {
    $stm = $db->connect()->prepare("SELECT company FROM vendor WHERE id=:id");
    $stm->bindValue(':id', $vendorid);
    $stm->execute();
    
    while($row = $stm->fetch()){

        $vendor.= $row['company'];
    }

    }catch(PDOException $e){
    echo $e->getMessage();
    }

    $subt=0;
    $total=0;



    ?>

<div class="containter">
              
              <h3 class="maintext">Pruchase Order Review</h3>
      
    <div class="frame">
       
       <span><?php echo $date; ?></span>
       <h5>Company : <?php echo $vendor; ?></h5>


        <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Item number</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
      <?php  $counter=0;
             $total=0;  
             
      foreach($product as $key => $v) { 
        
        $subtotal = $quantity[$key]*$unitprice[$key];
        $total = $total + $subtotal;
        ?>
          <tr>
            <th scope="row"><?php echo $counter +=1; ?></th>
            <td><?php echo $product[$key]; ?></td>
            <td> <?php echo $quantity[$key]; ?> </td>
            <td> <?php echo $unitprice[$key]; ?> </td>
            <td> <?php echo $subtotal; ?> </td>
          </tr>
          
      <?php } ?>

      <tr style="background-color:#cdcecc; font-weight:bold;">
          <td></td><td></td><td>TOTAL</td><td></td><td> <?php echo $total; ?> </td>
      </tr>
        </tbody>

        
      </table>

  <!-- form is here -->
      
       
      </div>    
                    </div>
       


          
<?php            
    // }  foreach
    
    
    try{

    $stmp = $db->connect()->prepare("INSERT INTO purchasement(vendor, totalprice, date)
        VALUES(:vendor, :totalprice, :date)");
        
        $stmp->bindValue(':vendor', $vendor);
        $stmp->bindValue(':totalprice', $total);
        $stmp->bindValue(':date', $date);
        $stmp->execute();

        // $stmp = $db->connect()->query("SELECT LAST_INSERT_ID()");
        //$id = $stmp->fetchColumn();

        $stmpr = $db->connect()->prepare("SELECT id FROM purchasement ORDER BY id DESC LIMIT 1");
        $stmpr->execute();
        
        while($row = $stmpr->fetch()) {

              $id = $row['id']; ?>

              <form action="delpurch.php" method="post">
              
              <input name="id" type="text" value="<?php echo $row['id']; ?>">
              <button class="btn btn-warning">Cancel</button>
              </form>

<?php              
        }

        echo $id;

       
        // $_SESSION['id'] = $id;

    }catch(PDOException $e){
        echo $e->getMessage();
        }
        
?>
        <form action="subpurchdet.php" method="post">
       <?php foreach($product as $key => $v) {  ?>
       <input name="product[]" type="text" value="<?php echo $product[$key]; ?>" >
       <input name="quantity[]" type="text" value="<?php echo $quantity[$key] ; ?>" >
       <input name="unitprice[]" type="text" value="<?php echo $unitprice[$key] ; ?>" >
       <?php }  ?>
       <input name="purchid" type="text" value="<?php echo $id ; ?>" ><br>
       
       <button class="btn btn-success">confirm</button>
       </form>

        
  <?php      
} 

include("../template/footer.php");


?>





