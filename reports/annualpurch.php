<?php 

include("../template/header.php"); 
include_once("../model/db.class.php");

?>


<div class="container" style="padding-bottom:10%; padding-top:3%;">
<a href="reportsmain.php" class="btn btn-outline-primary">صفحة التقارير الرئيسية</a>
<h5 style="text-align: center; margin-top:3%;" >تقرير المشتريات الشهرية لسنة</h5>
<form >

<div class="form-group">
    
    
    <select class="form-control" id="annpurch" dir="rtl" style="text-align-last:center;">
      <option value="">اختر السنة </option>
<?php
        for ($x = 2020; $x <= 2050; $x++) { ?>
 <option value="<?php echo $x; ?>" ><?php echo $x; ?></option>
 <?php        
        } 

?>
    
    </select>
  </div>

        

</form>

<table class="table table-striped" id="annpurchtable">
  <thead>
    <tr>
      
      <th scope="col">القيمة</th>
      <th scope="col">الشهر</th>

    </tr>
  </thead>
  <tbody>
    
     
    
   
  </tbody>
</table>

</div>




<?php 

include("../template/footer.php"); 

?>