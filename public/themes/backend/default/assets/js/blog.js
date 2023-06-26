function deletePersonRecord(obj, message) {
    var didConfirm = confirm(message);
    if (didConfirm == true) {
        var id = obj.attr('data-id');
        var targetDiv = obj.attr('targetDiv');
        jQuery('#rec-' + id).remove();

        //regnerate index number on table
        $('#tbl_persons_body tr').each(function (index) {
            //alert(index);
            obj.find('span.sn').html(index + 1);
        });
        return true;
    } else {
        return false;
    }
}

function addPersonRecord(size, title, role_id) {
    var content = jQuery('#person_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'rec-' + size);
    element.find('.delete_person_record').attr('data-id', size);
    element.find('.person_name').attr('id', 'person_name_' + size);
    element.find('.person_name').val(title);
    element.find('.person_name').attr('data-id', size);
    element.find('.person_id').attr('id', 'person_id_' + size);

    element.appendTo('#tbl_persons_body');
    element.find('.sn').html(size);
}

jQuery(document).delegate('a.add_person_record', 'click', function (e) {
    e.preventDefault();
    addPersonRecord(jQuery('#tbl_persons >tbody >tr').length + 1, '', 0);
});

//---------------------------------------------------------------------------------------------------------
function deleteBookRecord(obj, message) {
    var didConfirm = confirm(message);
    if (didConfirm == true) {
        var id = obj.attr('data-id');
        var targetDiv = obj.attr('targetDiv');
        jQuery('#rec-' + id).remove();

        //regnerate index number on table
        $('#tbl_books_body tr').each(function (index) {
            //alert(index);
            obj.find('span.sn').html(index + 1);
        });
        return true;
    } else {
        return false;
    }
}

function addBookRecord(size, title, role_id) {
    var content = jQuery('#book_table tr'),
        element = null,
        element = content.clone();
    element.attr('id', 'rec-' + size);
    element.find('.delete_book_record').attr('data-id', size);
    element.find('.book_name').attr('id', 'book_name_' + size);
    element.find('.book_name').val(title);
    element.find('.book_name').attr('data-id', size);
    element.find('.book_id').attr('id', 'book_id_' + size);

    element.appendTo('#tbl_books_body');
    element.find('.sn').html(size);
}

jQuery(document).delegate('a.add_book_record', 'click', function (e) {
    e.preventDefault();
    addBookRecord(jQuery('#tbl_books >tbody >tr').length + 1, '', 0);
});
//---------------------------------------------------------------------------------------------------------
CKEDITOR.replace('description');
$('input[name=title]').on('blur', function () {
    var slugElement = $('input[name=slug]');
    if (slugElement.val()) {
        return;
    }

    slugElement.val($('input[name=title]').val().toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
});
$('#published_at').pDatepicker({
    format: 'YYYY/MM/DD - HH:mm:ss',
    timePicker: {
        enabled: true
    },
    autoClose: true,
});
$('#tag_id').chosen({
    width: "100%",
    search_contains: true
});
$('#organization_id').chosen({
    width: "100%",
    search_contains: true
});
