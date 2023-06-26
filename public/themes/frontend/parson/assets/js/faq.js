$(document).ready(function(){


    $(".faq-btn").click(function (e) {
        var dropDown = $(this).closest(".question-box").find(".question-panel");
        $(this).closest(".faq-main-section").find(".question-panel").not(dropDown).slideUp();
       
        $(this).find('i').remove();
       
        if ($(this).hasClass("active")) {
          $(this).removeClass("active");
          $(this).closest('.faq-main-section').find('.question-title').css('color','#7b7b7b');
          $(this).find('i').remove();
          $(this).append('<i class="icon icon-Roll-down"></i>');
          
        } 
        else {
          $(this).closest(".faq-main-section").find(".faq-btn.active").removeClass("active");
          $(this).addClass("active");
           $('.faq-btn').find('i').remove();
          $('.faq-btn').append('<i class="icon icon-Roll-down"></i>');
          $(this).closest('.question-box').find('.question-title').css('color','#000000');
          
          
          $(this).find('i').remove();
          $(this).append('<i class="icon icon-Roll-up"></i>')
        }

        dropDown.stop(false, true).slideToggle(function(){
            if ($(this).is(':visible'))
            $(this).css('display','flex');
        });
        e.preventDefault();
      });







});




(function($){
  $(window).on("load",function(){
    
    $(".faq-main-section").mCustomScrollbar({
     
    });
    
  });
})(jQuery);