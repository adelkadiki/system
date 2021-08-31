<?php
include("../template/header.php"); 
require_once("../model/db.class.php");
require_once("../model/client.class.php");


if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];
    $clientPage = 'clientdetails.php?id='.$id;
    $delUrl = 'deleteclt.php?id='.$id;

    $db = new Database();
    $stm = $db->connect()->prepare("SELECT * FROM client WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();

?>

<div class="container" style="padding-top:3%;">

<a href="<?php echo $clientPage; ?>" class="btn btn-outline-primary">بيانات الزبون</a>

<h4 style="text-align:center;" >تعديل بيانات الزبون</h4>


<form method="post" action="subeditclient.php" >
<input type="hidden" value="<?php echo $id;?>" name="id">
<?php while($row=$stm->fetch()){ ?>

  <div class="form-group text-right">
    <label >الشركة (المحل)</label>
    <input name="company" type="text" class="form-control"  value="<?php echo $row['company']; ?>" >
    
  </div>

  <div class="form-group text-right">
    <label >المدير (الموظف)</label>
    <input name="manager" type="text" class="form-control" value="<?php echo $row['manager']; ?>">
  </div>

  <div class="form-group text-right">
    <label >العنوان</label>
    <input name="address" type="text" class="form-control" value="<?php echo $row['address']; ?>">
  </div>

  <div class="form-group text-right">
    <label >الهاتف</label>
    <input name="phone" type="text" class="form-control" value="<?php echo $row['phone']; ?>">
  </div>

  <div class="form-group text-right">
    <label >البريد الإلكتروني</label>
    <input name="email" type="text" class="form-control" value="<?php echo $row['email']; ?>">
  </div>

  <div class="form-group text-right">
    <label >الموقع الإلكتروني</label>
    <input name="website" type="text" class="form-control" value="<?php echo $row['website']; ?>">
  </div>
  <?php }?>
 
  <div class="row">
        <div class="col text-center">
  <button type="submit" class="btn btn-success" style="width: 120px;">تأكيد</button>
        </div>
   </div>     
</form>
<br><br><br>
</div>


<div class="row">
        <div class="col text-center">
          <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">حذف</button>
       </div>
    </div><br><br>

    <!-- confirm dialog -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <p style="text-align:center;" >
         
        حذف بيانات الزبون يعني جمع الفواتير المتعلقة بهذا الزبون ستحذف ، هل تريد حذف البيانات ؟               </p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" onclick="vendordelete(<?php echo $id; ?>)">إحذف</button> -->
        <a href="<?php echo $delUrl?>" class="btn btn-danger">إحذف</a>
        <button style="margin-left:65%;" type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm dialog -->

<?php 

}
include("../template/footer.php"); 

?>