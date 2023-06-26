@foreach($organizations as $organization)
    <label class="filter-check-row">
        <input type="checkbox" class="filter-check-input" data-id="{{ $organization->id }}">
        <span class="checkmark"></span>
        <span class="filter-check-text">{{ $organization->title }}</span>
    </label>
@endforeach
<script>
    var selected = [];
    $('#organization_checks input[type=checkbox]').click(function () {
        replaceUrlParam('sort', 1);
        replaceUrlParam('page', 1);
        replaceUrlParam('organization', generateChechBoxValueToUrl('organization_checks'));
        getFilterBooks();
        //alert($(this).attr('data-id'));
    });
    //alert(getUrlParameter('organization'));
    $("#organization_checks").find('input[type=checkbox]').each(function () {
        // some staff
        var ids = getUrlParameter('organization').split(',');
        for (i = 0; i < ids.length; i++) {
            if(ids[i] == $(this).attr('data-id')) this.checked = true;
        }
    });
</script>
