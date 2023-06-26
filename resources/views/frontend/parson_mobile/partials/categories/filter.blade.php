@foreach($categories as $category)
    <label class="filter-check-row">
        <input type="checkbox" class="filter-check-input" data-id="{{ $category->id }}">
        <span class="checkmark"></span>
        <span class="filter-check-text">{{ $category->title }}</span>
    </label>
@endforeach
<script>
    var selected = [];
    $('#category_checks input[type=checkbox]').click(function () {
        replaceUrlParam('sort', 1);
        replaceUrlParam('page', 1);
        replaceUrlParam('category', generateChechBoxValueToUrl('category_checks'));
        getFilterBooks();
        //alert($(this).attr('data-id'));
    });
    //alert(getUrlParameter('category'));
    $("#category_checks").find('input[type=checkbox]').each(function () {
        // some staff
        var ids = getUrlParameter('category').split(',');
        for (i = 0; i < ids.length; i++) {
            if(ids[i] == $(this).attr('data-id')) this.checked = true;
        }
    });
</script>
