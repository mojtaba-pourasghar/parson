@foreach($books as $book)
    @include(currentFrontView('partials.books.searched_book'),['book',$book])
@endforeach
<!-- pagination -->
{{ $books->appends($_GET)->links(currentFrontView('pagination')) }}
<!-- category-books-section -->
