<div class="naghd-book-row justify-content-center">
    <div class="naghd-book-col col-lg-1 col-md-3 col-7 ">
        <img src="{{  getBookImagePath($bookcomment->book->thumbnail) }}" alt="{{ $bookcomment->book->title }}">
    </div>
    <div class="naghd-book-content col-lg-11 col-md-9">
        <div class="book-content-top">

            <div class="user-profile-time-box col-12">
                <span class="profile-time-date">{{ $bookcomment->present()->CreateDate }}</span>
                <span class="profile-time-text">ساعت {{ $bookcomment->present()->CreateTime }}</span>
            </div>
        </div>
        <div class="book-content-middle">
            <p class="content-text">
                {{ $bookcomment->comment }}
            </p>
        </div>
        <div class="book-content-bottom">
            <div class="opinion-box-right col-8">
                      <span class="content-icon-box share-box"
                            onclick="popUp('shareModal', '{{ route('bookcommentshare.modal') }}',{'book_comment_id': '{{ $bookcomment->id }}','book_id': '{{ $bookcomment->book->id }}','slug': '{{ $bookcomment->book->slug }}','title': '{{ $bookcomment->book->title }}'});">
                        <i class="fal fa-share-alt"></i>
                      </span>
                <span class="content-icon-box flag-box"
                      onclick="popUp('reportModal', '{{ route('bookcommentreport.modal',$bookcomment->id) }}' );">
                                <i class="fal fa-flag"></i>
                              </span>
                <span class="content-icon-box replay-box">
                                  <i class="fal fa-reply"></i>
                              </span>
            </div>
            <div class="book-content-left col-4">
                <div class="opinion-box">
                    <span class="content-icon-box opinion-icon dislike-box"
                          data-id="{{ $bookcomment->id }}">
                      <i class="fal fa-thumbs-down fa-flip-horizontal"></i>
                      <span class="dislike-text">{{ $bookcomment->dislike_count }}</span>
                    </span>
                </div>
                <span class="content-icon-box opinion-icon like-box" data-id="{{ $bookcomment->id }}">
                  <i class="fal fa-thumbs-up"></i>
                  <span class="agree-text">{{ $bookcomment->like_count }}</span>
                </span>

            </div>
        </div>
    </div>

</div>

<script>
    //replay
    $('.user-opinion-box .like-box').click(function () {
        likeComment(1, $(this).attr("data-id"), '{{ route("bookcommentlike.add") }}', "{{ csrf_token() }}");
    });

    $('.user-opinion-box .dislike-box').click(function () {
        likeComment(0, $(this).attr("data-id"), '{{ route("bookcommentlike.add") }}', "{{ csrf_token() }}");
    });

</script>
