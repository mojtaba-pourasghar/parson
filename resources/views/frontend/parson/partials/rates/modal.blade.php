<div class="modal rating-book-modal show" role="dialog" id="rateModal">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close">×</button>
            </div>
            <span class="rating-box" data-stars="{{ !empty($bookrate->rate) ? $bookrate->rate : 0 }}" style="cursor: pointer;">
                  <span class="rate-cancel">
                    <img src="{{ frontendTheme('images/icon/cancel.png')}}" alt="">
                  </span>
            </span>

        </div>
    </div>
</div>
<script>
    $.ratePicker(".rating-box");
    $(".rating-box .fa-star").on('click', function () {
        value = $('.rating-box input[name="rating-box"]').val();
       /* alert(value);
        $('.r-empty-text').text(function () {
            return "امتیاز شما " + value;
        });*/

        $.ajax({
            headers: {headers: {'csrftoken': '{{ csrf_token() }}' }},
            url: '{{ route("rate.add") }}',
            type: 'post',
            cache: false,
            data : {"_token": "{{ csrf_token() }}","rate": value,"book_id": '{{ $book->id }}' },
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success){
                    toastr.success(data.message);
                    $('.rating-book-modal').modal('hide');
                }else{
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });

    });

    $('.rate-cancel').click(function(){
       /* $(".rating-box").attr('data-stars', '0');
        $.ratePicker(".rating-box");*/
        $('.rating-box .fa-star').css("color","rgb(211, 211, 211)");
        $('.rating-box .fa-star').last().css("color","transparent");
        $('.rating-box .fa-star').first().css("color","transparent");
    });
</script>
