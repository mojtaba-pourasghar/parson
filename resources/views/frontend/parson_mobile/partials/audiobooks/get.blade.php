<div class="d-book-info col-12">
    <div class="d-book-icon">
        <img src="{{ frontendTheme('images/icon/avatar.png')}}" alt="avatar">
    </div>
    <div class="d-book-title-box">
        <div class="d-book-title">
            <h3 class="d-title">گوینده</h3>
        </div>
        @if(count($audiobook->audio_book_person)>0)
            @foreach ($audiobook->audio_book_person as $person)
                <div class="d-book-title">
                    <h3 class="d-title">{{ $person->person->title }}</h3>
                </div>
            @endforeach
        @else
            <div class="d-book-title">
                <h3 class="d-title">@lang('book.not_register_yet')</h3>
            </div>
        @endif
    </div>
</div>
<div class="d-book-info col-12">
    <div class="d-book-icon">
        <img src="{{ frontendTheme('images/icon/clock.png')}}" alt="clock">
    </div>
    <div class="d-book-title-box">
        <div class="d-book-title">
            <h3 class="d-title">مدت زمان</h3>
        </div>
        <div class="d-book-title">
            <h3 class="d-title">دقیقه: {{ $audiobook->time }}</h3>

        </div>
    </div>
</div>
