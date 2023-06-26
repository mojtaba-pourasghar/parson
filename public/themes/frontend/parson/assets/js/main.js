$('document').ready(function(){
// menu dropdown
$('ul.navbar-nav li.dropdown').hover(function() {
	$(this).find('.megamenu-caret').stop(true, true).delay(200).fadeIn(300);
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
  }, function() {
  	$(this).find('.megamenu-caret').stop(true, true).delay(200).fadeOut(300);
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
  });
// menu dropdown end
});


// active menu 
$(document).ready(function(){
    $('ul.navbar-nav li').click(function(){
      $('li').removeClass("active");
      $(this).addClass("active");
  });
  });
$('document').ready(function(){
// scroll to top 

 
  //Check to see if the window is top if not then display button
  $(window).scroll(function(){
   
  
    //Click event to scroll to top
    $('.back-to-top').click( function() {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });
    
   });
 }); 
  