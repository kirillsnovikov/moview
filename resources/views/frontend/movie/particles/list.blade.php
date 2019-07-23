<div class="person__item__value">
    @foreach($persons as $person)
    <span>
        <a href="{{route('person', $person->slug)}}" class="link-underline">{{$person->name}}</a>
    </span>
    @endforeach
</div>