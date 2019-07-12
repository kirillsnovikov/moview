<section class="filmography-block">
    <div class="filmography">
        <p class="title main-color">Фильмография:</p>
        @if(count($person->directors))
            <h3 id="rezhisser">Режиссер</h3>
            @include('frontend.person.particles.list', ['movies' => $person->directors])
        @endif
        @if(count($person->actors))
            <h3 id="akter">Актер</h3>
            @include('frontend.person.particles.list', ['movies' => $person->actors])
        @endif
    </div>
</section>