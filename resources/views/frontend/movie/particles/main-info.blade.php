<section class="info">
    <div class="main-info">
        <div class="flex-row">
            <div class="main-info__year">
                <time datetime="{{$movie->premiere}}">{{date('Y', strtotime($movie->premiere))}}</time>
            </div>
            @if(count($movie->countries))
            <div class="main-info__country">
                @foreach($movie->countries as $country)
                <span>
                    <a href="{{route('country', $country->slug)}}">{{$country->title}}</a>
                </span>
                @endforeach
            </div>
            @endif
            <div class="main-info__raiting">
                <div class="flex">
                    @include('frontend.components.raiting')
                </div>
            </div>
            <div class="main-info__time nowrap">
                {{date('G\чi', mktime(0,$movie->duration)) . ' (' . $movie->duration . ' мин.)'}}
            </div>
        </div>
        <div class="flex">
            @if(count($movie->genres))
            <div class="main-info__genre cursive silver">
                @foreach($movie->genres as $genre)
                <span>
                    <a href="{{route('genre', [$movie->type->slug, $genre->slug])}}">{{ucfirst($genre->title)}}</a>
                </span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>