<section class="info">
    <div class="other-info">
        <div class="other-info__director">
            <div class="flex">
                <div class="other-info__director__label silver">Режиссер:</div>
                <div class="other-info__director__value">
                    @foreach($movie->directors as $director)
                    <span>
                        <a href="{{route('person', $director->slug)}}" class="link-underline">
                            {{$director->name}}
                        </a>
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="other-info__actor">
            <div class="flex">
                <div class="other-info__actor__label nowrap silver">В ролях:</div>
                <div class="other-info__actor__value">
                    @foreach($movie->actors as $actor)
                    <span>
                        <a href="{{route('person', $actor->slug)}}" class="link-underline">{{$actor->name}}</a>
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>