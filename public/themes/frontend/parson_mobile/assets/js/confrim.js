$(document).ready(function(){
   
     $('.count-down-confrim').css({"display": "none"});

    var interval;

function countdown() {
//   clearInterval(interval);
  interval = setInterval( function() {
      var timer = $('#timer').html();
      timer = timer.split(':');
      var minutes = timer[0];
      var seconds = timer[1];
      seconds -= 1;
      if (minutes < 0) return;
      else if (seconds < 0 && minutes != 0) {
          minutes -= 1;
          seconds = 59;
      }
      else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

      $('#timer').html(minutes + ':' + seconds);

      if (minutes == 0 && seconds == 0){
        clearInterval(interval);
        $('#timer').hide();
        $('.re-confrim-code').css({"display": "flex"});
      } 
  }, 1000);
}
countdown();
// }
$('.confrim-input').on("keyup", function() {

    var confrim = $('.confrim-input').val().length;
    if (confrim>0) {
    $('.confrim-input-underline').hide();
    
    }
    else{
        $('.confrim-input-underline').show();
    }
    
    });

});