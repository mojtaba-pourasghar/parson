@foreach($books as $book)
    @php
        $orgTitle = ' - ';
    @endphp
    @if(count($book->organizations)>0)
        @foreach($book->organizations as $organization)
            @php
                $orgTitle = $orgTitle.$organization->title.' | ';
            @endphp
        @endforeach
        @php
            $orgTitle = substr($orgTitle,0,strlen($orgTitle)-2);
        @endphp
    @else
        @php
            $orgTitle = '';
        @endphp
    @endif
    <option value="{{ $book->id }}">{{ $book->title.$orgTitle }}</option>
@endforeach

