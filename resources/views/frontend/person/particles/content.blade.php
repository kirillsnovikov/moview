<section class="content-block">
    <div class="content">
        <div class="card-person">
            <div class="card-poster">
                <img class="lazy-load-image "
                src="data:image/gif;base64,R0lGODlhAgADAIAAAP///wAAACH5BAEAAAEALAAAAAACAAMAAAICjF8AOw=="
                data-src="https://loremflickr.com/250/375/people/?random={{$person->image}}"
                alt="Фото '{{$person->name}}'"
                title="Фото '{{$person->name}}'"/>
                <div class="card-loader">@include('frontend.components.loader')</div>
            </div>
        </div>
        <div class="properties">
            <h1>{{$person->name}}</h1>
            <p class="title cursive">{{title_case($person->name_en)}}</p>
            @include('frontend.person.particles.main-info')
        </div>
        @include('frontend.person.particles.description')
        @include('frontend.person.particles.filmography')
    </div>
</section>