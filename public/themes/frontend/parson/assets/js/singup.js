$(document).ready(function(){
    $('#check-rule').change(function() {
       if ($(this).is(':checked')) {
           $('.singup-submit').prop('disabled', false);
         
       } else {
           $('.singup-submit').prop('disabled', true);
         
       }
     });
     
   });