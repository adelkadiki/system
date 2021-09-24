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

<div class="container" style="padding-top:3%;">
              
              <h3 class="maintext">بيانات طلب شراء</h3>
      
    <div class="frame">
       
       <div class="rightwriting"><?php echo $date; ?> التاريخ </div>
       <h5 class="rightwriting"> <?php echo $vendor; ?> الشركة</h5>


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
      <?php  $counter=0;
             $total=0;  
             
      foreach($product as $key => $v) { 

        
        $subtotal = $quantity[$key]*$unitprice[$key];
        $total = $total + $subtotal;
        ?>
          <tr>
          <td> <?php echo $subtotal; ?> </td>
          
            <td> <?php echo $quantity[$key]; ?> </td>
            <td> <?php echo $unitprice[$key]; ?> </td>
            <td><?php echo $product[$key]; ?></td>

            <th scope="row"><?php echo $counter +=1; ?></th>
          </tr>
          
      <?php } ?>

      <tr style="background-color:#cdcecc; font-weight:bold;">
          <td> <?php echo $total; ?> </td><td></td><td></td><td></td><td> الإجمالي </td>
      </tr>
        </tbody>

        
      </table>

  <!-- form is here -->
      
       
      </div>    
                    </div>
       


          
<?php            
    // }  foreach
    
    $id=0;
    
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

              <!-- <form action="delpurch.php" method="post">
              
              <input name="id" type="text" value="<?php echo $row['id']; ?>">
              <button class="btn btn-warning">Cancel</button>
              </form> -->

<?php              
        }

     $delUrl = 'delpurch.php?id='.$id;   
       // echo $id;

       
        // $_SESSION['id'] = $id;

    }catch(PDOException $e){
        echo $e->getMessage();
        }
        
?>
        <form action="subpurchdet.php" method="post">
       <?php foreach($product as $key => $v) {  ?>
       <input name="product[]" type="hidden" value="<?php echo $product[$key]; ?>" >
       <input name="quantity[]" type="hidden" value="<?php echo $quantity[$key] ; ?>" >
       <input name="unitprice[]" type="hidden" value="<?php echo $unitprice[$key] ; ?>" >
       <?php }  ?>
        <div class="container">
           <div class="row">
       <input name="purchid" type="hidden" value="<?php echo $id ; ?>" ><br>
            </div>
        </div>    

        <div class="row">
           <div class="col text-center">
       <button class="btn btn-success" style="width: 120px;">تأكيد</button>
            </div>
        </div>    

       </form>
       <br>

      
           <div class="row">
           <div class="col text-center">
       <a href="<?php echo $delUrl; ?>" style="width: 120px;" class="btn btn-warning">إلغاء</a>
          </div>
          </div>
      
        
  <?php      
} 

include("../template/footer.php");


?>





