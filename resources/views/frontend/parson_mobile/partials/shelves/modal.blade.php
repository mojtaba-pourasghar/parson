<!-- study modal -->
<div class="modal fade study-modal" id="studyModal" tabindex="-1" role="dialog"
     aria-labelledby="studyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="study-content-box">
                <div class="study-top-toast">
                    <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                        <div class="book-title">
                            {{ $book->title }}
                        </div>
                    </div>
                    <div class="study-box-row">
                        <div class="study-box-title want-study"><a href="#">@lang('book.i_want_to_read')</a></div>
                        <div class="study-box-title study"><a href="#">@lang('book.i_study')</a></div>
                        <div class="study-box-title studing"><a href="#">@lang('book.i_studing')</a></div>
                        <div class="study-toast-line"></div>
                    </div>
                    <span class="shelf-button">قفسه های من</span>
                </div>
                <div class="study-bottom-toast scrollbar-inner">
                    <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                        <span class="back-toast">
                                            <i class="fal fa-arrow-right"></i>
                                         </span>
                    </div>
                    <div class="study-box-row shelf_rows" id="">
                        <div class="study-box-title">
                            @foreach($shelves as $shelf)
                                <label class="filter-check-row">
                                    <input type="checkbox" data-id="{{ $shelf->id }}"
                                           class="filter-check-input shelf_checkbox"
                                           @foreach ($bookshelves as $bookshelf)
                                           @if ($bookshelf->shelf_id == $shelf->id)
                                           checked
                                        @break
                                        @endif
                                        @endforeach
                                    >
                                    <span class="checkmark"></span>
                                    <span class="filter-check-text">{{ $shelf->title }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="study-box-row">
                        <input type="text" class="shelf-name-input" placeholder="نام قفسه را وارد کنید">
                        <button class="btn btn-danger study-box-save">@lang('shelf.create_shelf')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // var button = $(event.relatedTarget); // Button that triggered the modal
    // var recipient = button.data('whatever'); // Extract info from data-* attributes

    // var modal = $('#studyModal');
    // modal.find('.study-content-box .book-title').text(recipient);

    function addBookShelf(shelf_id) {
        $.ajax({
            url: '{{ route("bookshelf.add") }}',
            type: 'post',
            cache: false,
            data: {"_token": "{{ csrf_token() }}", "book_id": '{{ $book->id }}', "shelf_id": shelf_id},
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });
    }

    function deleteBookShelf(shelf_id) {
        $.ajax({
            url: '{{ route("bookshelf.delete") }}',
            type: 'post',
            cache: false,
            data: {"_token": "{{ csrf_token() }}", "book_id": '{{ $book->id }}', "shelf_id": shelf_id},
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });
    }


    $(document).on('change', '.shelf_checkbox', function (e) {
        var shelf_id = $(this).attr("data-id");
        if (this.checked) {
            addBookShelf(shelf_id);
            //alert(shelf_id);
            studyState();
        } else {
            deleteBookShelf(shelf_id)
        }
    });


    $('.want-study').click(function (e) {
        e.preventDefault();
        $('#self_status_' + '{{ $book->id }}').text('{{ __('book.i_want_to_read') }}');
        $('#btn_showstudy_' + '{{ $book->id }}').css({
            "border": "1px solid #0F1E42",
            "background": "#fff",
            "color": "#707070"
        });
        addBookShelf(1);
    });

    function studyState() {
        $('#self_status_' + '{{ $book->id }}').text('{{ __('book.i_study') }}');
        $('#btn_showstudy_' + '{{ $book->id }}').css({
            "border": "1px solid #c6e2cc",
            "background": "#fff",
            "color": "#707070"
        });
    }

    $('.study').click(function (e) {
        e.preventDefault();
        studyState();
        addBookShelf(2);
    });

    $('.studing').click(function (e) {
        e.preventDefault();
        $('#self_status_' + '{{ $book->id }}').text('{{ __('book.i_studing') }}');
        $('#btn_showstudy_' + '{{ $book->id }}').css({
            "border": "1px solid #e72b47",
            "background": "#fff",
            "color": "#707070"
        });
        addBookShelf(3);
    });

    $('.shelf-button').click(function () {
        $(this).closest('.study-content-box').find('.study-top-toast').hide();
        $(this).closest('.study-content-box').find('.study-bottom-toast').fadeIn();
    });
    $('.back-toast').click(function () {
        $(this).closest('.study-content-box').find('.study-bottom-toast').hide();
        $(this).closest('.study-content-box').find('.study-top-toast').fadeIn();
    });


    //Study Dropdown Script

    function addShelf(x, value) {
        $.ajax({
            url: '{{ route("shelf.add") }}',
            type: 'post',
            cache: false,
            data: {"_token": "{{ csrf_token() }}", "title": value},
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);

                    if (x > 0) {
                        $('.study-box-save').closest('.study-bottom-toast').find('.study-box-title .filter-check-row:last-of-type')

                            .after('<label class="filter-check-row"><input type="checkbox" data-id="' + data.shelf_id + '" class="filter-check-input shelf_checkbox"><span class="checkmark"></span><span class="filter-check-text"></span></label>');
                        ;
                        $('.study-box-save').closest('.study-bottom-toast').find('.study-box-row:nth-of-type(2) .study-box-title .filter-check-row:last-of-type .filter-check-text').text(value);
                        $('.study-box-title .filter-check-input').click(function () {
                            $('.study-box-save').closest('.study-box').find('.study-content-box').slideUp();
                        });
                    }
                    $(".study-box-title .filter-check-row .filter-check-text").textlimit(20);

                } else {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });

    }

    //shelf text limited function
    $.fn.textlimit = function (limit) {
        return this.each(function (index, val) {
            var $elem = $(this);
            var $limit = limit;
            var $strLngth = $(val).text().length;  // Getting the text
            if ($strLngth > $limit) {
                $($elem).text($($elem).text().substr(0, $limit) + "...");
            }
        })
    };


    var value;
    var x;
    $(".shelf-name-input")
        .keyup(function () {
            value = $(this).closest('.study-bottom-toast').find(".shelf-name-input").val();
            x = value.length;
        });
    $('.study-box-save').click(function () {
        addShelf(x, value);
    });
    // $(".study-box-title .filter-check-text").textlimit(20);

    //End Study Dropdown Script


    $(document).ready(function(){
       // $('.scrollbar-inner').scrollbar();
        $('.shelf_rows').scrollbar();
    });



</script>
<!-- Share modal  -->
