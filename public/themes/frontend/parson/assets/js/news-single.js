$('document').ready(function(){
    $('#suggested-single-gallery').owlCarousel({
        autoplay:false,
        autoplayTimeout:2800,
        dots:true,
        items:5,
       loop:false,
       rtl:true,
       margin:0,
      
       nav:true,
       
     
     });
     $( ".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');
     $( ".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');

     	
 $('.sidebar-panel-box .scrollbar-inner').scrollbar();
});