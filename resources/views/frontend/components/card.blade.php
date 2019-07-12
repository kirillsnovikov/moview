<div class="card">
    <div class="card-poster">
        <a href="{{route('video', $movie->slug)}}" class="card-link-poster">

            <img class="lazy-load-image"
            src="data:image/gif;base64,R0lGODlhAgADAIAAAP///wAAACH5BAEAAAEALAAAAAACAAMAAAICjF8AOw=="
            data-src="https://loremflickr.com/250/375/art/?random={{rand(1, 100)}}"
            alt="Постер к фильму '{{$movie->title}}'"
            title="Постер к фильму '{{$movie->title}}'"/>
            <div class="card-info">
                <div>
                    <time datetime="{{$movie->premiere}}">{{date('Y', strtotime($movie->premiere))}}</time>
                </div>
                <div class="card-raiting">
                    <div class="flex-row-center">
                        <i class="icon-kinopoisk kinopoisk"></i>
                        <div>{{number_format(round(($movie->kp_raiting / 10000), 1), 1)}}</div>
                    </div>
                    <div class="flex-row-center">
                        <i class="icon-imdb imdb"></i>
                        <div>{{number_format(round(($movie->imdb_raiting / 10000), 1), 1)}}</div>
                    </div>
                </div>
            </div>
            <div class="card-loader">@include('frontend.components.loader')</div>
        </a>
    </div>

    <div class="card-description">
        <a href="{{route('video', $movie->slug)}}">
            <div class="card-description__title nowrap" alt="{{$movie->title}}">{{$movie->title}}</div>
        </a>
        <a href="{{route('video', $movie->slug)}}">
            <div class="card-description__title card-description__title__small nowrap cursive" alt="{{$movie->original_title}}">{{$movie->original_title}}</div>
        </a>
    </div>
</div>