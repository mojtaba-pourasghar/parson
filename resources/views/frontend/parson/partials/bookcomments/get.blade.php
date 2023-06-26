<div class="naghd-user-box col-12">
    @foreach($bookcomments as $bookcomment)

        <div class="naghd-user-row">
            <div class="user-inner-row">
                <div class="naghd-user-top-box">

                    <div class="naghd-user-avatar-box col-7">

                        <div class="naghd-user-image">
                            <a href="{{ route('user.profile',[$bookcomment->user->id,$bookcomment->user->name]) }}">
                                <img src="{{ getUserImagePath($bookcomment->user->image) }}"
                                     alt="{{ $bookcomment->user->name }}">
                            </a>
                        </div>
                        <h3 class="user-top-title">
                            <a href="{{ route('user.profile',[$bookcomment->user->id,$bookcomment->user->name]) }}">
                                {{ $bookcomment->user->name }}
                            </a>
                        </h3>

                    </div>

                    <div class="user-opinion-time-box col-5">
                                  <span class="opinion-time-date">
                                          {{ $bookcomment->present()->CreateDate }}
                                  </span>
                        <span class="opinion-time-text">
                                          ساعت {{ $bookcomment->present()->CreateTime }}
                                  </span>
                    </div>
                </div>
                <div class="naghd-user-bottom-box">
                    @if($bookcomment->reveal_status==1)
                        <div class="naghd-user-bottom-content expose-box col-md-8 col-12">
                            <div class="naghd-user-bottom-content user-content-expose">
                                <div class="user-bottom-content justify-content-md-start
                                    justify-content-center col-lg-9 col-md-8 col-12">
                                      <span class="content-expose-alert-box">
                                        <img src="{{ frontendTheme('images/icon/warning.png') }}" alt="warning">
                                      </span>
                                    <h3 class="content-expose-text">این پیام حاوی لو رفتن داستان است
                                    </h3>

                                </div>
                                <div class="expose-more-button-box col-lg-3 col-md-4">
                                    <button class="btn btn-danger">مشاهده</button>
                                </div>
                            </div>
                            <p class="user-bottom-content book_comment_{{ $bookcomment->id }}">
                                {{ $bookcomment->comment }}
                            </p>
                            <!--  -->

                        </div>
                    @else
                        <p class="user-bottom-content book_comment_{{ $bookcomment->id }}">
                            {{ $bookcomment->comment }}
                        </p>
                    @endif
                    <div class="opinion-box-right col-8">
                                  <span class="content-icon-box share-box"
                                        onclick="popUp('shareModal', '{{ route('bookcommentshare.modal') }}',{'book_comment_id': '{{ $bookcomment->id }}','book_id': '{{ $book->id }}','slug': '{{ $book->slug }}','title': '{{ $book->title }}'});"
                                  >
                                          <i class="fal fa-share-alt"></i>
                                  </span>
                        @if (Auth::check())
                            @if(auth()->id() == $bookcomment->user_id)
                                <span class="content-icon-box pen-box"
                                      onclick="popUp('editModal', '{{ route('bookcomment.modal',[$bookcomment->id,$bookcomment->is_question]) }}' );"><i
                                        class="fal fa-pen"></i></span>
                            @else
                                <span class="content-icon-box flag-box"
                                      onclick="popUp('reportModal', '{{ route('bookcommentreport.modal',$bookcomment->id) }}' );">
                                          <i class="fal fa-flag"></i>
                                  </span>
                                <span class="content-icon-box replay-box" data-id="{{$bookcomment->id}}"><i
                                        class="fal fa-reply"></i>
                                  </span>
                            @endif


                        @endif
                    </div>
                    <div class="user-opinion-box col-4">
                        @if(auth()->id() != $bookcomment->user_id)
                            <div class="opinion-box">
                                <span class="content-icon-box opinion-icon like-box" data-id="{{ $bookcomment->id }}">
                                   <i class="fal fa-thumbs-up"></i>
                                </span>
                            </div>
                            <div class="opinion-box">
                                <span class="content-icon-box opinion-icon dislike-box"
                                      data-id="{{ $bookcomment->id }}">
                                  <i class="fal fa-thumbs-down fa-flip-horizontal"></i>
                                </span>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            @if ( $bookcomment->replies )
                @foreach($bookcomment->replies as $reply)
                    <div class="user-inner-row">
                        <div class="naghd-user-top-box">
                            <div class="naghd-user-avatar-box col-7">
                                <div class="naghd-user-image">
                                    <img src="{{ getUserImagePath($reply->user->image) }}"
                                         alt="{{ $reply->user->name }}">
                                </div>
                                <h3 class="user-top-title">{{ $reply->user->name }}</h3>
                            </div>
                            <div class="user-opinion-time-box col-5">
                                  <span class="opinion-time-date">
                                         {{ $reply->present()->CreateDate }}
                                  </span>
                                <span class="opinion-time-text">
                                          ساعت {{ $reply->present()->CreateTime }}
                                  </span>
                            </div>
                        </div>
                        <div class="naghd-user-bottom-box">
                            @if($reply->reveal_status==1)
                                <div class="naghd-user-bottom-content expose-box col-md-8 col-12">
                                    <div class="naghd-user-bottom-content user-content-expose">
                                        <div class="user-bottom-content justify-content-md-start
                                    justify-content-center col-lg-9 col-md-8">
                                      <span class="content-expose-alert-box">
                                        <img src="{{ frontendTheme('images/icon/warning.png') }}" alt="warning">
                                      </span>
                                            <h3 class="content-expose-text">این پیام حاوی لو رفتن داستان است
                                            </h3>

                                        </div>
                                        <div class="expose-more-button-box col-lg-3 col-md-4">
                                            <button class="btn btn-danger">مشاهده</button>
                                        </div>
                                    </div>
                                    <p class="user-bottom-content book_comment_{{ $reply->id }}">
                                        {!! convertMention($reply->comment) !!}
                                    </p>


                                </div>
                            @else
                                <p class="user-bottom-content book_comment_{{ $reply->id }}">
                                    {!! convertMention($reply->comment) !!}
                                </p>
                            @endif
                            <div class="opinion-box-right col-8">
                                  <span class="content-icon-box share-box"
                                        onclick="popUp('shareModal', '{{ route('bookcommentshare.modal') }}',{'book_comment_id': '{{ $reply->id }}','book_id': '{{ $book->id }}','slug': '{{ $book->slug }}','title': '{{ $book->title }}'});">
                                          <i class="fal fa-share-alt"></i>
                                  </span>
                                @if (Auth::check())
                                    @if(auth()->id() == $reply->user_id)
                                        <span class="content-icon-box pen-box"
                                              onclick="popUp('editModal', '{{ route('bookcomment.modal',[$reply->id,$reply->is_question]) }}' );">
                                        <i class="fal fa-pen"></i>
                                    </span>
                                    @else
                                        <span class="content-icon-box flag-box"
                                              onclick="popUp('reportModal', '{{ route('bookcommentreport.modal',$reply->id) }}' );">
                                          <i class="fal fa-flag"></i>
                                    </span>
                                    @endif

                                @endif

                            </div>
                            <div class="user-opinion-box col-4">
                                @if(auth()->id() != $reply->user_id)
                                    <div class="opinion-box">
                                        <span class="content-icon-box opinion-icon like-box" data-id="{{ $reply->id }}">
                                           <i class="fal fa-thumbs-up"></i>
                                        </span>
                                    </div>
                                    <div class="opinion-box">
                                        <span class="content-icon-box opinion-icon dislike-box"
                                              data-id="{{ $reply->id }}">
                                          <i class="fal fa-thumbs-down fa-flip-horizontal"></i>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</div>
<!-- end naghd user box -->
<!-- pagination -->
{{ $bookcomments->links(currentFrontView('pagination')) }}

<script>
    //replay
    $('.naghd-user-bottom-box .replay-box').click(function () {
        var text = $(this).closest('.user-inner-row').find('.user-top-title').text();
        $('.reply_to').val($(this).attr("data-id"));
        $('html, body').animate({
            scrollTop: $('#comment').offset().top
        }, 800);
        $(this).closest('.book-comment-content').find('.review-comment').text(function () {
            return "@" + text.trim().replace(' ', '_') + " ";
        });
    });

    $('.user-opinion-box .like-box').click(function () {
        likeComment(1, $(this).attr("data-id"), '{{ route("bookcommentlike.add") }}', "{{ csrf_token() }}");
    });

    $('.user-opinion-box .dislike-box').click(function () {
        likeComment(0, $(this).attr("data-id"), '{{ route("bookcommentlike.add") }}', "{{ csrf_token() }}");
    });

</script>
