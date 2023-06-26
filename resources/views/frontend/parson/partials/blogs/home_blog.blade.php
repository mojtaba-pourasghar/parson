<div class="col-12">
    <div class="column-last-news">
        <div class="last-news-image-box col-12">
            <img src="{{ getBlogImagePath($blog->thumbnail) }}" alt="{{ $blog->title }}">
        </div>
        <div class="last-news-title-box col-12">
            <h2 class="last-news-title"><a href="{{ route('blog.view',[$blog->id,$blog->slug]) }}">{{ $blog->title }}</a></h2>
        </div>
        <div class="last-news-content col-12">
            <p>{{ $blog->excerpt }}</p>
        </div>

        <div class="last-news-more-box col-12">
            <h2 class="last-news-more"><a href="{{ route('blog.view',[$blog->id,$blog->slug]) }}">
                    <span class="more-icon fas fa-plus"></span>بیشتر</a></h2>
        </div>
    </div>
</div>
