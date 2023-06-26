
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
$('#category_id').chosen({
    width: "100%",
    search_contains: true
});
$('#textile_id').chosen({
    width: "100%",
    search_contains: true
});
