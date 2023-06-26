$(document).ready(function(){


var nonLinearSlider = document.getElementById('nonlinear');

noUiSlider.create(nonLinearSlider, {
    connect: true,
    behaviour: 'tap',
    direction: 'rtl',
    range: {
        'min': 1000,
        '10%': 10000,
        '20%': 20000,
        '30%': 30000,
        '40':50000,
      
        '50%':60000,
        '60%': 70000,
        '70%':90000,
        '80%':100000,
        '90%':110000,
        'max':125000
    },
    format: wNumb({
        decimals:0,
        thousand: ',',
        suffix: 'تومان '
    }),
    snap: true,
    start: [1000, 125000]

});
var skipValues = [
    document.getElementById('lower-value'),
    document.getElementById('upper-value')
];

nonLinearSlider.noUiSlider.on('update', function (values, handle) {
    skipValues[handle].innerHTML = values[handle];
});
   
}); 
  // Display the slider value and how far the handle moved