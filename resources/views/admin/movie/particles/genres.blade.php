@foreach ($genres as $genre)

    <option value="{{$genre->id ?? old('id') ?? ''}}"
        @isset($movie->id)
            @foreach ($movie->genres as $movie_genre)
                @if($genre->id == $movie_genre->id)
                    selected
                @endif
            @endforeach
        @endisset
    >
        {{$genre->title ?? old('title') ?? ''}}
    </option>

@endforeach
