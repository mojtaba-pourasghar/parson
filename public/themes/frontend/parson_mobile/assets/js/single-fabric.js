// fabric toolbar
$(document).ready(function(){
  $(window).scroll(function(){

    if($(this).scrollTop() > 175) {
  $('.tool-box-top').css({"position":"fixed", "background":"#f4c13e"});

}
else{
  $('.tool-box-top').css({"position":"absolute ", "background":"transparent"});

}
});
});
// fabric single slider
const swiper = new Swiper('.fabric-slider-box .swiper-container', {
  effect: 'slide',

  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true,
  },
  slidesPerView: 1,
  autoplay: {
    delay:3000,
    stopOnLastSlide:false,
    pauseOnMouseEnter:false,
  },
  watchSlidesVisibility: true,

 });
