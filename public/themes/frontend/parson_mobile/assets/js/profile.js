$('document').ready(function(){

  $('#pruser').on('show.bs.modal', function (event) {
    var pr_click=$(event.relatedTarget);
    var recipient = pr_click.data('whatever');

  // var main_title= $(this).find('.pr-title').text();
  //  $('.modal-content .main-title').html(main_title);
  $('#save-btn').click(function(){
    var input_data=$(this).closest('.modal-content').find('.input-edit').val();
    pr_click.find('.edit-input').val(input_data);
  });
  $('.group-pr-form').click(function(){

    var main_title= $(this).find('.pr-box-title .pr-title').text();
    //$('.modal-content .main-title').html(main_title);


  });

});
$('#prpass').on('show.bs.modal', function (event) {
  var pr_click=$(event.relatedTarget);
  var recipient = pr_click.data('whatever');

// var main_title= $(this).find('.pr-title').text();
//  $('.modal-content .main-title').html(main_title);
$('#save-btn').click(function(){
  var input_data=$(this).closest('.modal-content').find('.input-edit').val();
  pr_click.find('.edit-input').val(input_data);
});
$('.group-pr-form').click(function(){

  var main_title= $(this).find('.pr-box-title .pr-title').text();
  $('.modal-content .main-title').html(main_title);


});

});


});






