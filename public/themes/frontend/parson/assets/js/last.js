$('document').ready(function(){
  $('#carousel-top-product').owlCarousel({
    autoplay:false,
    // autoplayTimeout:2800,
   autoWidth: true,
   loop:false,
   rtl:true,
   margin:5,
   items:4,
   nav:true,
   dots:false
  
  });
    $( ".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $( ".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');
    
     	
 $('.sidebar-panel-box .scrollbar-inner').scrollbar();    
});   