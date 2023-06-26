$('document').ready(function(){
$('#top-fabric-carousel').owlCarousel({
  autoplay:true,
  autoplayTimeout:2800,
    loop:true,
    rtl:true,
    margin:0,
    items:1,
    nav:true,
    dots: true,
    dotsData: true,
});
$( ".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
$( ".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');



$('#main-slider').owlCarousel({
  autoplay:true,
  autoplayTimeout:3000,
  loop:true,
  rtl:true,
  margin:0,
  items:1,
  nav:true,
  dots:true

});

$('#carousel-off-product').owlCarousel({
   autoplay:false,
  //  autoplayTimeout:2800,
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

var swiper = new Swiper('.swiper-container#carousel-off-product', {
  watchSlidesProgress:true,
   watchSlidesVisibility: true,
   loop:false,
   grabCursor: true,
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next',
    
  },
  slidesPerView:3,

})

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

      });