<div class="naghd-user-box col-12">

    @foreach($blogcomments as $blogcomment)

        <div class="naghd-user-row">
            <div class="user-inner-row">
                <div class="naghd-user-top-box">

                    <div class="naghd-user-avatar-box col-7">

                        <div class="naghd-user-image">
                            <a href="{{ route('user.profile',[$blogcomment->user->id,$blogcomment->user->name]) }}">
                                <img src="{{ getUserImagePath($blogcomment->user->image) }}"
                                     alt="{{ $blogcomment->user->name }}">
                            </a>
                        </div>
                        <h3 class="user-top-title">
                            <a href="{{ route('user.profile',[$blogcomment->user->id,$blogcomment->user->name]) }}">
                                {{ $blogcomment->user->name }}
                            </a>
                        </h3>

                    </div>

                    <div class="user-opinion-time-box col-5">
                                  <span class="opinion-time-date">
                                          {{ $blogcomment->present()->CreateDate }}
                                  </span>
                        <span class="opinion-time-text">
                                          ساعت {{ $blogcomment->present()->CreateTime }}
                                  </span>
                    </div>
                </div>
                <div class="naghd-user-bottom-box">
                    @if($blogcomment->reveal_status==1)
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
                            <p class="user-bottom-content blog_comment_{{ $blogcomment->id }}">
                                {{ $blogcomment->comment }}
                            </p>
                            <!--  -->

                        </div>
                    @else
                        <p class="user-bottom-content blog_comment_{{ $blogcomment->id }}">
                            {{ $blogcomment->comment }}
                        </p>
                    @endif
                    <div class="opinion-box-right col-8">

                        @if (Auth::check())
                            @if(auth()->id() == $blogcomment->user_id)
                                <span class="content-icon-box pen-box"
                                      onclick="popUp('editModal', '{{ route('blogcomment.modal',[$blogcomment->id,$blogcomment->is_question]) }}' );"><i
                                        class="fal fa-pen"></i></span>
                            @else
                                <span class="content-icon-box flag-box"
                                      onclick="popUp('reportModal', '{{ route('blogcommentreport.modal',$blogcomment->id) }}' );">
                                          <i class="fal fa-flag"></i>
                                  </span>
                                <span class="content-icon-box replay-box" data-id="{{$blogcomment->id}}"><i
                                        class="fal fa-reply"></i>
                                  </span>
                            @endif


                        @endif
                    </div>
                    <div class="user-opinion-box col-4">

                    </div>

                </div>
            </div>
            @if ( $blogcomment->replies )
                @foreach($blogcomment->replies as $reply)
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
                                    <p class="user-bottom-content blog_comment_{{ $reply->id }}">
                                        {!! convertMention($reply->comment) !!}
                                    </p>


                                </div>
                            @else
                                <p class="user-bottom-content blog_comment_{{ $reply->id }}">
                                    {!! convertMention($reply->comment) !!}
                                </p>
                            @endif
                            <div class="opinion-box-right col-8">
                                  <span class="content-icon-box share-box"
                                        onclick="popUp('shareModal', '{{ route('blogcommentshare.modal') }}',{'blog_comment_id': '{{ $reply->id }}','blog_id': '{{ $blog->id }}','slug': '{{ $blog->slug }}','title': '{{ $blog->title }}'});">
                                          <i class="fal fa-share-alt"></i>
                                  </span>
                                @if (Auth::check())
                                    @if(auth()->id() == $reply->user_id)
                                        <span class="content-icon-box pen-box"
                                              onclick="popUp('editModal', '{{ route('blogcomment.modal',[$reply->id,$reply->is_question]) }}' );">
                                        <i class="fal fa-pen"></i>
                                    </span>
                                    @else
                                        <span class="content-icon-box flag-box"
                                              onclick="popUp('reportModal', '{{ route('blogcommentreport.modal',$reply->id) }}' );">
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
{{ $blogcomments->links(currentFrontView('pagination')) }}

<script>
    //replay
    $('.naghd-user-bottom-box .replay-box').click(function () {
        var text = $(this).closest('.user-inner-row').find('.user-top-title').text();
        $('html, body').animate({
            scrollTop: $('#comment').offset().top
        }, 800);
        $('.reply_to').val($(this).attr("data-id"));
        $(this).closest('.blog-comment-content').find('.review-comment').text(function () {
            return "@" + text.trim().replace(' ', '_') + " ";
        });
    });


</script>
