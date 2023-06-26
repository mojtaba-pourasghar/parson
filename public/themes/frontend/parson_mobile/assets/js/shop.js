// shop sidebar
$('documen').ready(function(){
    $('.sidebar-panel-box .scrollbar-inner').scrollbar();
});

// active sort
// active menu
$(document).ready(function(){
    $('.shop-sort-box .sort-item').click(function(){
      $('.sort-item').removeClass("active");
      $(this).addClass("active");
  });
  });

  var nonLinearSlider = document.getElementById('nonlinear');

var slider = noUiSlider.create(nonLinearSlider, {
    connect: true,
    behaviour: 'tap',
    direction: 'rtl',
    range: {
        'min': 0,
        'max': __max_price
    },
    step: 100,
    format: wNumb({
        decimals:0,
        thousand: ',',
        suffix: 'ریال '
    }),

    start: [0, __max_price]

});
var skipValues = [
    document.getElementById('lower-value'),
    document.getElementById('upper-value')
];

nonLinearSlider.noUiSlider.on('update', function (values, handle) {
    skipValues[handle].innerHTML = values[handle];
});


  // Display the slider value and how far the handle moved
