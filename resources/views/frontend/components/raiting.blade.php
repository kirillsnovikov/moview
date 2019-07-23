@if($movie->kp_raiting)
<div class="kp-raiting">
    <div class="flex-row-center">
        <i class="icon-kinopoisk kinopoisk"></i>
        <div>{{number_format(round(($movie->kp_raiting / 10000), 1), 1)}}</div>
    </div>
</div>
@endif
@if($movie->imdb_raiting)
<div class="imdb-raiting">
    <div class="flex-row-center">
        <i class="icon-imdb imdb"></i>
        <div>{{number_format(round(($movie->imdb_raiting / 10000), 1), 1)}}</div>
    </div>
</div>
@endif