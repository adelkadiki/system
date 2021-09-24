$(document).ready(function(){


  

 $('#datePicker').daterangepicker({
    singleDatePicker: true,
    //showButtonPanel: false,
    // showDropdowns: true,
    locale: {
        format: 'YYYY-MM-DD'
    },
    

 });

 $('.repdate').daterangepicker({
  singleDatePicker: true,
  //showButtonPanel: false,
  // showDropdowns: true,
  locale: {
      format: 'YYYY-MM-DD'
  },
  

});

$('#anotherproduct').click(function(){
   
    
    $( "#addproduct" ).clone(true, true).insertBefore("#anotherproduct").find("input[type='text']").val("") ; 
    
    // newPro.addClass("cls"+count);
    //  count +=1;
    return false;
});

$('.btn-danger').click(function(){
    // var cls= $(this).parent().attr("class");
    // alert(cls);
   $(this).parent().remove();
    
    
});


$("#salesearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#salestable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

 
  

  $('#clienttable').DataTable(

    {
      "oLanguage" : {
        
        "sSearch": "بحث"
      }  ,
      
      // "lengthChange": false,
      // "dom": '<"pull-right" f><t>'  
  } 
  );

  $('#vendorstable').DataTable(

    {
      "oLanguage" : {
        
        "sSearch": "بحث"
      }  ,
      
      // "lengthChange": false,
      // "dom": '<"pull-right" f><t>'  
  } 
  );

  $('#salestable').DataTable({

    "oLanguage" : {
        
      "sSearch": "بحث",
      
    }  ,

  });
  
  $('#fromdate').mousedown(function(){

    $('.reportalert').hide();

  });

  $('#todate').mousedown(function(){

    $('.reportalert').hide();

  });
 
  // select year for annual pruchase report function
$('#annpurch').change(function(){

  var year =  $(this).val();
  
  $.ajax({

    type: 'post',
    url: 'getannpurch.php',
                
     data : {year:year} ,
   
     dataType: 'json',
     success: function (response) {
      
      $('#annpurchtable tbody tr td').remove();

     
      var mon = 1;
      for(let res of response){

          if(res==null){
              res = '-'
          }

        $('#annpurchtable tbody').append('<tr> <td>'+res+'</td><td>'+mon+'</td> </tr>');
       
            mon ++;
           }
    }
    });


});

// select year for annual sales report function

$('#annsales').change(function(){

  var year =  $(this).val();
  

  $.ajax({

    type: 'post',
    url: 'getannsales.php',
                
     data : {year:year} ,
   
     dataType: 'json',
     success: function (response) {
     
      
      
      $('#annpurchtable tbody tr td').remove();

     
      var mon = 1;
      for(let res of response){

          if(res==null){
              res = '-'
          }
        
          $('#annpurchtable tbody').append('<tr> <td>'+res+'</td><td>'+mon+'</td> </tr>');
            mon ++;
        
          }
    }
    });


});


// ALLPURCHS.PHP table

$('#allpurches').DataTable(

  {
    "oLanguage" : {
      
      "sSearch": "بحث"
    }  ,
    
    
} 
);

// allpurches table

});

// ready main function

// LOGIN FUNCTION
var count = 0;

function loginfunc(){ 

  count +=1;

  if(count > 3){

    window.location.href = 'passreset.php';
  }

  $('#loginuserpass').hide();
  $('#usernamewarn').hide();

  var username = $('#loguser').val();
  var password = $('#logpass').val();
  
  if(username == "" || password == ""){

    $('#usernamewarn').show();
  
  }else {

  $.ajax({

    type: 'post',
    url: 'authen.php',
                
    data : {username:username, password:password},
  
    success: function (response){

       if(response == true){
        
        window.location = 'cp.php';
       
        } else {
          
          $('#loginuserpass').show();
           
       }

     }

  });
}
  
}

// LOGIN FUNCTION


// verify email function


function emailsend(){

  $('#emailwarn').hide();
  $('#emailvalid').hide();
  $('#emailnotfound').hide();

   var email = $('#emailadd').val();

   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  

  if(email == ""){
      $('#emailwarn').show();
  
    }
  
  else if(!regex.test(email)){

      $('#emailvalid').show();
    
    }else {

      $.ajax({

        type: 'post',
        url: 'emailcheck.php',
                    
        data : {email:email},
      
        success: function (response){
    
           if(response == true){
            
            $('#emailresetform').submit();
           
            } else {
              
              $('#emailnotfound').show();
               
           }
    
         }
    

      });
    }
}



$('#delwarn').click(function(){
    

   
  
      var conf= confirm("testin line");
  
      if(conf==true){
    
        $('#clientdelform').submit();      
        
    }else if(conf==false){

        location.reload();
    }
      
    
  
  });
  


function getselect(option){
    
    
    $.ajax({
        type: 'post',
        url: 'findvendor.php',
                    
         data : {vendorid:option} ,
       
         
         success: function (response) {
            
           $('#vendor option').remove();
           $('#vendor').append('<option value="">إختر السلعة</option>');
           $('#vendor').append(response);
           
           
        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }
        });


}

// NEW PURCHASE FUNCTION

function newpurchsub(){

  $('#clientwarn').hide();
  $('#numbers').hide();
  $('#duplicatewarn').hide();

  var sub = true;
  
  $('.purchdata').each(function() {
    
    
    if(isNaN(this.value) || this.value==""){
      
      $('#numbers').show();
  
      sub=false;
     
    }
    
  });

  var opts  = [];
  $('#newinvform').find('select').each(function(){
   
   
    
    opts.push(this.value);

    opts.sort();
    
    for(var i=0; i<opts.length-1; i++ ){
        if(opts[i]===opts[i+1]){

          sub=false;
          $('#duplicatewarn').show();
       
         
        }
    }

 });
 
 
      if(opts[0]==""){
      $('#clientwarn').show(); 
      sub=false;
 }

      return sub;
}

// NEW INVOICE FUNCTION

function newinvoice(){


  $('#clientwarn').hide();
  $('#numbers').hide();
  $('#duplicatewarn').hide();

  var sub = true;
  
  $('.purchdata').each(function() {
    
    
    if(isNaN(this.value) || this.value==""){
      
      $('#numbers').show();
  
      sub=false;
     
    }
    
  });

  var opts  = [];
  $('#newinvform').find('select').each(function(){
   
   // console.log((this).value);
    
    opts.push(this.value);

    opts.sort();
    
    for(var i=0; i<opts.length-1; i++ ){
        if(opts[i]===opts[i+1]){

          //console.log(opts[i]);
          sub=false;
          $('#duplicatewarn').show();
        //   $("#prodsel > option").each(function() {

        //         if(this.value == opts[i]){
        //           $(this).parent().attr('class', 'warningborder');
        //         }
            
        // });
         
        }
    }
    //sub = false;
 });
 
 
      if(opts[0]==""){
      $('#clientwarn').show(); 
      sub=false;
 }

      return sub;

}

// NEW PRODUCT VALIDATION FUNCTION
function newprodsub(){

  $('#productwarn').hide();
  $('#compwarn').hide();
  $('#addprodsucess').hide();

  var sub = true;
  var prodcut = $('#addprodfield').val();
  var company = $('#prodcomp').val();
  
  if(prodcut == ""){
      $('#productwarn').show();
      sub=false;
  }

  if(company == ""){
    $('#compwarn').show();
     sub=false;
  }

  if(sub == true){

    $('#newprodform').submit();
  
  }

  //return sub;

}


// NEW VENDOR VALIDATION FUNCTION

function newvendsubmit(){

  var company = $('#company').val() ;
  

  if(company==""){
  
    $('#companywarn').show();
  
  }else {
      //$('#newvendorform').submit();
    
      $.ajax({
   
        type: 'post',
        url: 'vendcheck.php',
                    
         data : {company:company},
       
         success: function (response) {
          
            if(response==true){
    
              $('#newvendorform').submit();                   
               
               }else {

                    $('#companywarn').hide();
                    $('#vendordup').show() ;
     
                }
          }
    
        });
    
  }

}


function addnewclient(){
 
  var comp = $('#compname').val();
  
  if(comp==""){
  
    $('#emptyclientwarn').show();    
   
  
   }
  
  
  else {

    

  $.ajax({
   
    type: 'post',
    url: 'findclient.php',
                
     data : {company:comp},
   
     success: function (response) {
      
      if(response==true){

        $('#newclientform').submit();
           
     }else {

        $('#emptyclientwarn').hide();          
        $('#duplicatewarn').show();        

          }
    }

    });

  }

}
// end of function

function resetpass(){


  var email = $('#emailreset').val();
  
  
  $.ajax({
   
    type: 'post',
    url: 'emailvref.php',
                
     data : {email:email},
   
     success: function (response) {
      
      if(response == 0){

        // $('#newclientform').submit();
        $('#emailresetalert').show();        
           
     } else {

        //alert(response) ;    
        window.location = 'passreset.php?email='+email;    

          }
    }
    });
}

function purchreport(){

 // var fromdate = Date.parse(($('#fromdate').val())) ;
 // var todate =  Date.parse(($('#todate').val()))  ;

  var fromdate = $('#fromdate').val();
  var todate =  ($('#todate').val()) ;

  if(fromdate === todate || fromdate > todate){
     
    $('.reportalert').show() ;
  
    }else {

     
      $.ajax({
   
        type: 'post',
        url: 'purchreport.php',
                    
         data : {fromdate:fromdate , 
                 todate:todate},
       
         success: function (response) {    
                
                  $('.total').empty();
                  $('.total').append(response);

            }
        });
    }
}

function deletesales(e){

  window.location = 'delsales.php?id='+e;
  
}


function productdelete(e){

 window.location = 'delproduct.php?id='+e;

}

function purchorderdelete(e){
  window.location = 'deletepurch.php?id='+e;
}

