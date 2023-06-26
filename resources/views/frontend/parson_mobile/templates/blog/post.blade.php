<article>
    <h2>{{ $blog->title }}</h2>
    <p>
        Posted by {{ $blog->author->name }} on {{ $blog->published_at }}
        {!! $blog->present()->excerptHtml or $blog->present()->bodyHtml !!}
    </p>
</article>
