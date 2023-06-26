<!-- report modal -->
<div class="modal fade report-modal" id="reportModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="report-content-box">
                <div class="report-main-box">
                    <div class="report-header-row">
              <span class="close-report" data-dismiss="modal">
                <i class="fal fa-times"></i>
              </span>

                    </div>
                    <div class="report-box-row">
                        <div class="report-title-box report-spam-btn {{ $abusive }}"><a
                                href="#">@lang('bookcomment.abusive')</a></div>
                        <div class="report-title-box report-expose-btn {{ $transpire_story }}"><a
                                href="#">@lang('bookcomment.transpire_story')</a></div>

                        <textarea class="form-control report-comment" id="report_comment" rows="5"
                                  placeholder="@lang('bookcomment.enter_your_other_reason')">
                         @if(!empty($bookcommentreport))
                                {{ $bookcommentreport->report }}
                            @endif
                        </textarea>

                        @if(empty($bookcommentreport))
                            <button class="btn btn-danger report-box-save">@lang('message.save')</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end report -->
<script>
    $('.report-spam-btn').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
    $('.report-expose-btn').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });


    function addReportComment() {
        var report_type = '';

        if ($('.report-spam-btn').hasClass('active')) {
            report_type = '1';
        }
        if ($('.report-expose-btn').hasClass('active')) {
            report_type = '2';
        }

        if ($('.report-spam-btn').hasClass('active') == true && $('.report-expose-btn').hasClass('active') == true) {
            report_type = '1,2';
        }

        $.ajax({
            url: '{{ route("bookcommentreport.add") }}',
            type: 'post',
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "report": $('#report_comment').val(),
                'report_type': report_type,
                'book_comment_id': '{{ $book_comment_id }}',
            },
            datatype: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                    $('#reportModal').modal('toggle');
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, textStatus, thrownError) {
                toastr.error(__the_operation_failed);
            }
        });
    }

    $('.report-box-save').click(function () {
        addReportComment();
    });

</script>
