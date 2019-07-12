@foreach ($types as $type)

    <option value="{{$type->id ?? old('id') ?? ''}}"
        @isset($movie->id)
            @if($type->id == $movie->type_id)
                selected
            @endif
        @endisset
    >
        {{$type->title ?? old('title') ?? ''}}
    </option>

@endforeach
