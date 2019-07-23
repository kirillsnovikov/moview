<section class="content-block">
    <div class="content">
        <div class="card-person">
            <div class="card-poster">
                <img class="lazy-load-image "
                src="data:image/gif;base64,R0lGODlhAgADAIAAAP///wAAACH5BAEAAAEALAAAAAACAAMAAAICjF8AOw=="
                data-src="https://loremflickr.com/250/375/art/?random={{$movie->image}}"
                alt="Постер к фильму {{$movie->title}}'"
                title="Постер к фильму {{$movie->title}}'"/>
                <div class="card-loader">@include('frontend.components.loader')</div>
            </div>
        </div>
        <div class="properties">
            <h1>{{$movie->title}}</h1>
            <p class="title cursive">{{title_case($movie->original_title)}}</p>
            @include('frontend.movie.particles.main-info')
        </div>
        @include('frontend.movie.particles.person')
        @include('frontend.movie.particles.description')
        @include('frontend.movie.particles.player')
    </div>
</section>