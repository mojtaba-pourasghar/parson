<div class="kethab-search-container container">

    <div class="search-box col-12">
        {!! Form::model('', [
                            'route' => ['books.search'],
                            'method' => 'get'] ) !!}

        <div class="search-box-control">
            <input type="search" class="form-control search-control"
                   placeholder="بر اساس نام کتاب، نویسنده، ناشر و ... جستجو کن " name="title">
            <button type="submit" class="btn btn-danger btn-search-box">جستجو</button>
        </div>
        <div class="search-option">
            <div class="search-option-column col-lg-2 col-md-6 col-sm-8 col-10">
                <h2 class="search-option-title">بر اساس موضوع</h2>
                <div class="search-option-box">
                    <ul class="list-unstyled search-option-list col-12">
                        @foreach($categories as $category)
                            <li class="search-option-item justify-content-center"><a
                                    href="{{ route('category.view',[$category->id,$category->slug]) }}">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="search-option-more">
                    <h3 class="option-more-title">
                        <a href="{{ route('categories.search') }}">
                            <span class="more-icon fas fa-plus"></span>
                            بیشتر
                        </a></h3>
                </div>

            </div>
            <div class="search-option-column col-lg-4 col-md-6 col-sm-8 col-10">
                <h2 class="search-option-title">بر اساس نویسنده</h2>
                <div class="search-option-box">
                    <ul class="list-unstyled search-option-list col-6">
                        @if (count($writers)>0)
                            @foreach($writers as $key=>$writer)
                                @if ($key<6)
                                    <li class="search-option-item"><a
                                            href="{{ route('writer.view',[$writer->id,$writer->slug]) }}">{{ $writer->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <ul class="list-unstyled search-option-list col-6">

                        @if (count($writers)>6)
                            @foreach($writers as $key=>$writer)
                                @if ($key>=6)
                                    <li class="search-option-item"><a
                                            href="{{ route('writer.view',[$writer->id,$writer->slug]) }}">{{ $writer->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="search-option-more">
                    <h3 class="option-more-title"><a href="{{ route('writers.search') }}">
                            <span class="more-icon fas fa-plus"></span>
                            بیشتر
                        </a></h3>
                </div>

            </div>
            <div class="search-option-column col-lg-4 col-md-6 col-sm-8 col-10">
                <h2 class="search-option-title">بر اساس مترجم</h2>
                <div class="search-option-box">
                    <ul class="list-unstyled search-option-list col-6">
                        @if (count($translators)>0)
                            @foreach($translators as $key=>$translator)
                                @if ($key<6)
                                <li class="search-option-item"><a
                                        href="{{ route('translator.view',[$translator->id,$translator->slug]) }}">{{ $translator->title }}</a>
                                </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <ul class="list-unstyled search-option-list col-6">
                        @if (count($translators)>6)
                            @foreach($translators as $key=>$translator)
                                @if ($key>=6)
                                    <li class="search-option-item"><a
                                            href="{{ route('translator.view',[$translator->id,$translator->slug]) }}">{{ $translator->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="search-option-more">
                    <h3 class="option-more-title"><a href="{{ route('translators.search') }}">
                            <span class="more-icon fas fa-plus"></span>
                            بیشتر
                        </a></h3>
                </div>

            </div>
            <div class="search-option-column col-lg-2 col-md-6 col-sm-8 col-10">
                <h2 class="search-option-title">بر اساس ناشر</h2>
                <div class="search-option-box">
                    <ul class="list-unstyled search-option-list col-12">
                        @foreach($organizations as $organization)
                            <li class="search-option-item"><a
                                    href="{{ route('organization.view',[$organization->id,$organization->slug]) }}">{{ $organization->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="search-option-more">
                    <h3 class="option-more-title"><a href="{{ route('organizations.search') }}"><span
                                class="more-icon fas fa-plus"></span>بیشتر</a></h3>
                </div>

            </div>

        </div>
        {!! Form::close() !!}
    </div>

</div>
