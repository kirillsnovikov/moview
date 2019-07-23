<section class="info">
    <div class="main-info">
        <div class="flex-row">
            @if($movie->premiere)
            <div class="main-info__year">
                <time datetime="{{$movie->premiere}}">{{date('Y', strtotime($movie->premiere))}}</time>
            </div>
            @endif
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
                    <div class="raiting">
                        @include('frontend.components.raiting')
                    </div>
                </div>
            </div>
            @if($movie->duration)
            <div class="main-info__time nowrap">
                {{date('G\чi', mktime(0,$movie->duration)) . ' (' . $movie->duration . ' мин.)'}}
            </div>
            @endif
        </div>
        @if(count($movie->genres))
        <div class="flex">
            <div class="main-info__genre cursive silver">
                @foreach($movie->genres as $genre)
                <span>
                    <a href="{{route('genre', [$movie->type->slug, $genre->slug])}}">{{ucfirst($genre->title)}}</a>
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>