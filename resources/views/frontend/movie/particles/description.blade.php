@if($movie->description)
<section class="description-block">
    <p class="title main-color">Описание фильма:</p>
    <div class="description">{{$movie->description}}</div>
</section>
@endif