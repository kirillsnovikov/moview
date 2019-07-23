@if(count($movie->directors) || count($movie->actors))
<section class="person-block">
    <div class="person">
        <p class="title main-color">Создатели фильма:</p>
        @if(count($movie->directors))
        <div class="person__item">
            <div class="flex">
                <div class="person__item__label silver">Режиссер:</div>
                @include('frontend.movie.particles.list', ['persons' => $movie->directors]);
            </div>
        </div>
        @endif
        @if(count($movie->actors))
        <div class="person__item">
            <div class="flex">
                <div class="person__item__label nowrap silver">В ролях:</div>
                @include('frontend.movie.particles.list', ['persons' => $movie->actors]);
            </div>
        </div>
        @endif
    </div>
</section>
@endif