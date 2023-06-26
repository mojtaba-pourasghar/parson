/*
$('#organization_id').chosen({
    width: "100%",
    search_contains: true
});
//$('#person_id').chosen();
//$('#role_id').chosen();
*/
$('#category_id').chosen({
    width: "100%",
    search_contains: true
});

$('#discount_type_id').chosen({
    width: "100%",
    search_contains: true
});
$('#textile_type_id').chosen({
    width: "100%",
    search_contains: true
});

$('#hashtag_id').chosen({
    width: "100%",
    search_contains: true
});

$('#price_pattern_id').chosen({
    width: "100%",
    search_contains: true
});
CKEDITOR.replace('description');


function deleteColorRecord(obj, message) {
    var didConfirm = confirm(message);
    if (didConfirm == true) {
        var id = obj.attr('data-id');
        var targetDiv = obj.attr('targetDiv');
        jQuery('#recColor-' + id).remove();

        //regnerate index number on table
        $('#tbl_colors_body tr').each(function (index) {
            //alert(index);
            obj.find('span.sn').html(index + 1);
        });
        return true;
    } else {
        return false;
    }
}

function addColorRecord(size) {
    var content = jQuery('#sample_color_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'recColor-' + size);
    element.find('.delete_color_row').attr('data-id', size);
    element.find('.color_code').attr('id', 'color_code_' + size);
    var color = $('#color').val();
    element.find('.color_code').val(color);
    element.appendTo('#tbl_colors_body');
    element.find('.sn').html(size);
    new jscolor($('#tbl_colors_body tr:last').find('.jscolor')[0]);
}

function editColorRecord(size,color) {
    var content = jQuery('#sample_color_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'recColor-' + size);
    element.find('.delete_color_row').attr('data-id', size);
    element.find('.color_code').attr('id', 'color_code_' + size);
    element.find('.color_code').val(color);
    element.appendTo('#tbl_colors_body');
    element.find('.sn').html(size);
    new jscolor($('#tbl_colors_body tr:last').find('.jscolor')[0]);
}


function deleteImageRecord(obj, message) {
    var didConfirm = confirm(message);
    if (didConfirm == true) {
        var id = obj.attr('data-id');
        var targetDiv = obj.attr('targetDiv');
        jQuery('#recImage-' + id).remove();

        //regnerate index number on table
        $('#tbl_colors_body tr').each(function (index) {
            //alert(index);
            obj.find('span.sn').html(index + 1);
        });
        return true;
    } else {
        return false;
    }
}

function addImageRecord(size) {
    var content = jQuery('#sample_image_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'recImage-' + size);
    element.find('.delete_image_row').attr('data-id', size);
    element.find('.image').attr('id', 'image_' + size);
   // element.find('.image').val(color);
    element.appendTo('#tbl_images_body');
    element.find('.sn').html(size);
}

function editImageRecord(size,image,old_image) {

    var content = jQuery('#sample_image_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'recImage-' + size);
    element.find('.delete_image_row').attr('data-id', size);
    element.find('.image').attr('id', 'image_' + size);
    element.find('.current_image').attr('src', image);
    element.find('.old_image').val(old_image);
    element.appendTo('#tbl_images_body');
    element.find('.sn').html(size);
}


function getDeoTitle(code,url,token) {
    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: ''/*{ 'userid': name}*/, //see the $_token
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (response) {
            //var data = $.parseJSON(data);
            if (response.success == true) {

                $('#deo_label').text(response.data);
            } else {
                $('#deo_label').text('');
            }
        },
        error: function (xhr, textStatus, thrownError) {
            $('#deo_label').text('');
        }
    });
}
function getPricePattern( url, token,price,textile_id) {

    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: { 'price': price,'textile_id':textile_id}, //see the $_token
        datatype: 'html',
        beforeSend: function () {
            //something before send
        },
        success: function (data) {
            console.log('success');
            console.log(data);
            //success
            //var data = $.parseJSON(data);
            if (data.success == true) {
                //user_jobs div defined on page
                $('#price_item_place').html(data.html);
            } else {
                $('#price_item_place').html('');
            }
        },
        error: function (xhr, textStatus, thrownError) {
            //alert(xhr + "\n" + textStatus + "\n" + thrownError);
            $('#price_item_place').html('');
        }
    });
}
