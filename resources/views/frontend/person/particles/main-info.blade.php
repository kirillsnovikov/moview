<section class="info">
    <div class="main-info">
        <div class="flex-row">
            @if($age)
            <div class="main-info__age">{{$age}}</div>
            @endif
            @if(isset($person->height))
            <div class="main-info__height"><i class="icon-height silver"></i>{{$person->height}} см</div>
            @endif
            <div class="demography flex-row">
                @if(isset($person->birth_date))
                <span class="flex-row">
                    <div class="main-info__date flex-row">
                        <div class="main-info__date__birth">
                            <time datetime="{{$person->birth_date}}">{{date('d.m.Y', strtotime($person->birth_date))}}</time>
                        </div>
                        @if(isset($person->death_date))
                        <div class="main-info__date__death">
                            <time datetime="{{$person->death_date}}">{{date('d.m.Y', strtotime($person->death_date))}}</time>
                        </div>
                        @endif
                    </div>
                </span>
                @endif
                @if(isset($person->countryBirth))
                <span>
                    <div class="main-info__geo">
                        <a href="{{route('country', $person->countryBirth->slug)}}">{{$person->countryBirth->title}}</a>
                    </div>
                </span>
                @endif
            </div>
        </div>
        <div class="flex-row">
            @if(count($person->professions))
            <div class="main-info__profession cursive silver">
                @foreach($person->professions as $profession)
                <span>
                    <a href="#{{$profession->slug}}">{{$profession->title}}</a>
                </span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>