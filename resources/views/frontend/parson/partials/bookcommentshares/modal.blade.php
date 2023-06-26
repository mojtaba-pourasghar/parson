@php

   $url = route('book.view',[$book_id,$title]);

   $twitter_params =
   '?text=' . urlencode($title) . '+-' .
   '&amp;url=' . urlencode($url) .
   '&amp;counturl=' . urlencode($url) .
   '';
   $twitter_link = "http://twitter.com/share" . $twitter_params . "";

@endphp
<div class="modal fade share-modal" id="shareModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close">&times;</button>
            </div>
            <div class="modal-share-row">
                <span class="content-icon-box">
                  <i class="fal fa-share-alt"></i>
                </span>
            </div>
            <div class="share-icons-row">
              <span class="content-icon-box">
                <a href="#">
                  <img src="{{ frontendTheme('images/icon/telegram-main.png')}}"
                       alt="telegram-main">
                </a>
              </span>
                <span class="content-icon-box">
                <a href="#">
                  <img src="{{ frontendTheme('images/icon/whatsapp.png')}}" alt="whatsapp">
                </a>
              </span>
                <span class="content-icon-box">
                    <a href="{{ $twitter_link }}" target="_blank">
                      <img src="{{ frontendTheme('images/icon/twitter-main.png')}}" alt="twitter-main">
                    </a>
                  </span>
                <span class="content-icon-box">
                    <a href="#">
                      <img src="{{ frontendTheme('images/icon/link.png')}}" alt="link">
                    </a>
                  </span>
            </div>
        </div>
    </div>
</div>

