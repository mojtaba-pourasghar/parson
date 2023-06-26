<!-- edit Modal -->
<div class="modal fade edit-modal" id="editModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="edit-content-box">
                <div class="edit-main-box">
                    <div class="edit-header-row">
                              <span class="close-edit" data-dismiss="modal">
                                <i class="fal fa-times"></i>
                              </span>
                    </div>
                    <div class="edit-box-row">
                                <span class="delete-icon">
                                    <i class="fal fa-trash-alt"></i>
                                </span>
                        <textarea class="form-control col-md-9 col-10 edit-comment" rows="5" placeholder="" name="edit_comment" id="edit_comment">
                            {{ trim($bookcomment->comment) }}
                        </textarea>
                        <button type="button" class="btn btn-danger edit-box-save">@lang('message.save')</button>
                        <button type="button" class="btn btn-default edit-box-reset">@lang('message.cancel')</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end edit Modal -->
<script>


    function updateComment(id) {
        $.ajax({
            url: '{{ route("bookcomment.update",$bookcomment->id) }}',
            type: 'put',
            cache: false,
            data: {"_token": "{{ csrf_token() }}", "comment": $('#edit_comment').val(),'is_question':'{{ $is_question }}'},
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                    $('.book_comment_'+id).text(data.comment);
                    $('#editModal').modal('toggle');
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });
    }

    $('.edit-box-save').click(function () {
        updateComment('{{ $bookcomment->id }}');
    });

    $('.edit-box-reset').click(function () {
        $('#editModal').modal('toggle');
    });
</script>
