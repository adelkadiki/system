<?php 
include("../template/header.php"); 
?>

<div class="container" style="padding-top:3%; padding-left:10%;">

<a href="reportsmain.php" class="btn btn-outline-primary" style="margin-bottom:70px;">صفحة التقارير الرئيسية</a>
<div style="text-align:center; font-size:25px; " >إجمالي البيع و الشراء</div><br>



<div class="alert alert-danger reportalert" role="alert">
يرجى إختيار تاريخ بداية يسبق تاريخ النهاية
</div>


<form action="purchreport.php" method="post">

  <div class="form-group">
  <button type="button" onclick="purchreport()" class="btn btn-success">إرسـال</button>
    
  <input type="text" name="todate" class="repdate" id="todate">
    <label for="exampleInputEmail1">إلي</label>

    <input type="text" name="fromdate" class="repdate" id="fromdate">
    <label for="exampleInputEmail1">من</label>
    
    
  </div>

</form>
<br><br>
<div class="total" style="text-align:center; font-size:35px; font-weight: 700;" ></div>

<!-- purchase part -->



</div>


<?php 
include("../template/footer.php"); 
?>
