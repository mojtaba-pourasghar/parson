<div class="row">
    <div class="col-md-12" style="background-image: url({{ theme('images/homepage.jpg') }}); background-size: 100%;height: 320px; "></div>
</div>
dfdf
<div class="row">
    @foreach($blogs as $blog)
        <div class="col-md-4">
            <h2><a href="#">{{ $blog->title }}</a></h2>
        </div>
        <p>
            Posted by {{ $blog->author->name }} on {{ $blog->published_at }}
            {!! $blog->present()->excerptHtml or $blog->present()->bodyHtml !!}
        </p>
    @endforeach
</div>
