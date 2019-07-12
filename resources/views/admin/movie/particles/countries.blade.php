@foreach ($countries as $country)

	<option value="{{$country->id ?? old('id') ?? ''}}"
	
		@isset($movie->id)
			@foreach ($movie->countries as $country_movie)
				@if($country->id == $country_movie->id)
					selected=""
				@endif
			@endforeach
		@endisset
		>
		
		{!! $delimiter ?? old('delimiter') ?? '' !!}{{$country->title ?? old('title') ?? ''}}
	</option>

@endforeach
