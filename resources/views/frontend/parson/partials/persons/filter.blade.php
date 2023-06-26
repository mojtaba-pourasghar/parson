@foreach($persons as $person)
    <label class="filter-check-row">
        <input type="checkbox" class="filter-check-input" data-id="{{ $person->id }}">
        <span class="checkmark"></span>
        <span class="filter-check-text">{{ $person->title }}</span>
    </label>
@endforeach

@if(getConstant('person_role.writer') == $person_role_id)
    <script>
        $('#writer_checks input[type=checkbox]').click(function () {
            replaceUrlParam('sort', 1);
            replaceUrlParam('page', 1);
            replaceUrlParam('writer', generateChechBoxValueToUrl('writer_checks'));
            getFilterBooks();
        });

        $("#writer_checks").find('input[type=checkbox]').each(function () {
            // some staff
            var ids = getUrlParameter('writer').split(',');
            for (i = 0; i < ids.length; i++) {
                if(ids[i] == $(this).attr('data-id')) this.checked = true;
            }
        });

    </script>
@endif

@if(getConstant('person_role.translator') == $person_role_id)
    <script>
        $('#translator_checks input[type=checkbox]').click(function () {
            replaceUrlParam('sort', 1);
            replaceUrlParam('page', 1);
            replaceUrlParam('translator', generateChechBoxValueToUrl('translator_checks'));
            getFilterBooks();
        });

        $("#translator_checks").find('input[type=checkbox]').each(function () {
            // some staff
            var ids = getUrlParameter('translator').split(',');
            for (i = 0; i < ids.length; i++) {
                if(ids[i] == $(this).attr('data-id')) this.checked = true;
            }
        });
    </script>
@endif

