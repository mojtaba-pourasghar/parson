{!! Form::label(__('book.book_title'),null,['class' => 'col-sm-2 control-label']) !!}
<div class="col-sm-3">
    {!! Form::text('book', $title , ['class' => 'form-control','id'=>'book']) !!}
</div>
<div class="col-sm-4">
    {!! Form::select('book_id',[] , null, ['data-placeholder'=>__('book.please_enter_book_title'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'book_id']) !!}
</div>

@if(!empty($title))
    <script>
        var name = $('#book').val();
        var url = '{{ route("backend.books.getbooks", ":title") }}';
        url = url.replace(':title', name);
        getBooks(name, url, '{{ csrf_token() }}', 'book_id');
    </script>
@endif

<script>

    $('#book_id').chosen({
        width: "100%",
        search_contains: true
    });

    $("#book").keyup(function () {
        var name = $(this).val();
        var url = '{{ route("backend.books.getbooks", ":title") }}';
        url = url.replace(':title', name);
        getBooks(name, url, '{{ csrf_token() }}', 'book_id');
    });
</script>
