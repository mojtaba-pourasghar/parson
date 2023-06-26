$('document').ready(function(){
    $('#suggested-gallery').owlCarousel({
        autoplay:false,
        autoplayTimeout:2800,
        dots:true,
        items:3,
       loop:false,
       rtl:true,
       margin:0,
      
       nav:true,
       
     
     });
     $( ".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
     $( ".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');
    

     	
 $('.sidebar-panel-box .scrollbar-inner').scrollbar();
});