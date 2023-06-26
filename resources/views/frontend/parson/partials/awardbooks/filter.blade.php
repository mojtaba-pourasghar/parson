@foreach($awardbooks as $awardbook)
    <label class="filter-check-row">
        <input type="checkbox" class="filter-check-input" data-id="{{ $awardbook->year }}">
        <span class="checkmark"></span>
        <span class="filter-check-text">{{ $awardbook->year }}</span>
    </label>
@endforeach


<script>
    $('#awardbook_year_checks input[type=checkbox]').click(function () {
        replaceUrlParam('sort', 1);
        replaceUrlParam('page', 1);
        replaceUrlParam('awardbook_year', generateChechBoxValueToUrl('awardbook_year_checks'));
        getFilterBooks();
    });

    $("#awardbook_year_checks").find('input[type=checkbox]').each(function () {
        // some staff
        var ids = getUrlParameter('awardbook_year').split(',');
        for (i = 0; i < ids.length; i++) {
            if (ids[i] == $(this).attr('data-id')) this.checked = true;
        }
    });

</script>


