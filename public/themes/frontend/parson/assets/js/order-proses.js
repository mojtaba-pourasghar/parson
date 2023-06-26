$('.send-product-nav li:first-child').addClass('active');
$('.product-tab-content').hide();
$('.product-tab-content:first').show();

// Click function
$('.send-product-nav li').click(function(){
  $('.send-product-nav li').removeClass('active');
  $(this).addClass('active');
  $('.product-tab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});

// select time tab 
$('.time-nav-main .time-nav-item:first-child').addClass('active');
// $('.time-tab-content .time-select-content').hide();
//  $('.time-tab-content:first-child').show();

// Click function
$('.time-nav-main .time-nav-item').click(function(){
  $('.time-nav-main .time-nav-item').removeClass('active');
  $(this).addClass('active');
  $('.time-tab-content .time-select-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
// select time tab end

