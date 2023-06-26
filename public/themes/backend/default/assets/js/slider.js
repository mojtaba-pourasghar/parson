

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

function editImageRecord(size,image,old_image,image_title) {

    var content = jQuery('#sample_image_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'recImage-' + size);
    element.find('.delete_image_row').attr('data-id', size);
    element.find('.image').attr('id', 'image_' + size);
    element.find('.current_image').attr('src', image);

    element.find('.current_title').attr('value', image_title);
    element.find('.old_image').val(old_image);
    element.appendTo('#tbl_images_body');
    element.find('.sn').html(size);
}


