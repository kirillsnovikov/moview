<section class="player-block">
    <div class="player">
        @if(isset($movie->kodik_link))
        <iframe src="{{$movie->kodik_link . '?translations=false'}}" width="610" height="370" frameborder="0" allowfullscreen></iframe>
        @endif
    </div>
</section>