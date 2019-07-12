<ul class="unstyled filmography">
    @forelse($movies as $movie)
    <li>
        <a href="{{route('video', $movie->slug)}}">
            <time class="time" datetime="{{$movie->premiere}}">{{date('Y', strtotime($movie->premiere))}}</time>
            <div class="movie-link">
                {{$movie->title}}
                <p class="movie-link__original">{{$movie->original_title}}</p>
            </div>
            @include('frontend.components.raiting')
        </a>
    </li>
    @empty
    <li>Нет фильмов</li>
    @endforelse
</ul>