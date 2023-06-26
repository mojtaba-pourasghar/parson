$(document).ready(function(){
var visible_pass=$('.toggle-password');
visible_pass.on('click', function() {
$(this).toggleClass('icon-eye icon-eye-crossed');
var $target = $(this).siblings('.input-pwd');
if ($target.attr('type') == "password") {$target.attr('type','text');}
else {$target.attr('type','password');}
});
});