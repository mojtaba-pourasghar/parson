@foreach($books as $book)
    <option value="{{ $book->id }}">{{ $book->title }}</option>
@endforeach

