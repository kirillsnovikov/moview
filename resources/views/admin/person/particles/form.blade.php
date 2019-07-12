<div class="form-group row">
    <div class="col">
        <input class="form-control mb-3" type="text" placeholder="Имя" name="firstname" value="{{$person->name ?? old('name') ?? ''}}"/>
        <input class="form-control mb-3" type="text" placeholder="Имя" name="firstname" value="{{$person->firstname ?? old('firstname') ?? ''}}"/>
        <input class="form-control mb-3" type="text" placeholder="Фамилия" name="lastname" value="{{$person->lastname ?? old('lastname') ?? ''}}" />
        <input class="form-control mb-3" type="text" placeholder="Фамильная приставка" name="lastneme_prefix" value="{{$person->lastneme_prefix ?? old('lastneme_prefix') ?? ''}}" />
        <input class="form-control mb-3" type="text" placeholder="Среднее(второе) имя" name="middlename" value="{{$person->middlename ?? old('middlename') ?? ''}}" />
        <input class="form-control mb-3" type="text" placeholder="Третье имя" name="middlename_second" value="{{$person->middlename_second ?? old('middlename_second') ?? ''}}" />
        <input class="form-control mb-3" type="text" placeholder="Четвертое имя" name="middlename_third" value="{{$person->middlename_third ?? old('middlename_third') ?? ''}}" />
        <input class="form-control mb-3" type="text" placeholder="Пятое имя" name="middlename_fourth" value="{{$person->middlename_fourth ?? old('middlename_fourth') ?? ''}}" />
    </div>
    <div class="col">
        <select class="form-control mb-3" name="published">

            @if (isset($person->id))

            <option value="0" @if($person->published == 0) selected="" @endif>Не опубликовано</option>
            <option value="1" @if($person->published == 1) selected="" @endif>Опубликовано</option>

            @else

            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>

            @endif

        </select>
        <input class="form-control-file form-control-lg" type="file" name="image" value="{{$person->image_name ?? old('image_name') ?? ''}}"/>

        <div class="row mb-3">
            <label class="col-form-label col-4" for="">Дата рождения</label>
            <div class="col">
                <input class="form-control" type="date" name="birth_date" value="{{$person->birth_date ?? old('birth_date') ?? ''}}"/>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-4" for="">Дата смерти</label>
            <div class="col">
                <input class="form-control" type="date" name="death_date" value="{{$person->death_date ?? old('death_date') ?? ''}}"/>
            </div>
        </div>

        <input class="form-control mb-3" type="number" placeholder="Рост" name="tall" min="1" max="300" step="1" value="{{$person->tall ?? old('tall') ?? ''}}"/>
        <select class="form-control mb-3" name="sex">

            @if (isset($person->id))

            <option value="0" @if($person->sex == 0) selected="" @endif>Мужской</option>
            <option value="1" @if($person->sex == 1) selected="" @endif>Женский</option>

            @else

            <option value="0">Мужской</option>
            <option value="1">Женский</option>

            @endif

        </select>
        <input class="form-control mb-3" type="number" placeholder="Кинопоиск ID" name="kp_id" min="1" step="1" value="{{$person->kp_id ?? old('kp_id') ?? ''}}" required/>
    </div>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input class="form-control" type="text" placeholder="Автоматическая генерация" name="slug" value="{{$person->slug ?? old('slug') ?? ''}}" readonly/>
</div>

<div class="form-group row">
    <div class="col-6">
        <label for="">Профессия</label>
        <select class="form-control" name="professions[]" multiple>

            @include('admin.person.particles.professions')

        </select>
    </div>
    <!--    <div class="col-6">
            <label for="">Страна</label>
            <select class="form-control" name="countries[]" multiple>



            </select>
        </div>-->
</div>

<div class="form-group">
    <label for="">Краткое описание</label>
    <textarea  class="form-control" name="description_short" id="description_short">{{$person->description_short ?? old('description_short') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="">Описание</label>
    <textarea  class="form-control" name="description" id="description" rows="7">{{$person->description ?? old('description') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="">Мета заголовок</label>
    <input class="form-control" type="text" placeholder="Мета заголовок" name="meta_title" value="{{$person->meta_title ?? old('meta_title') ?? ''}}"/>
</div>

<div class="form-group">
    <label for="">Мета описание</label>
    <input class="form-control" type="text" placeholder="Мета описание" name="meta_description" value="{{$person->meta_description ?? old('meta_description') ?? ''}}"/>
</div>

<div class="form-group">
    <label for="">Ключевые слова</label>
    <input class="form-control" type="text" placeholder="Ключевые слова" name="meta_keywords" value="{{$person->meta_keywords ?? old('meta_keywords') ?? ''}}"/>
</div>

<input class="btn btn-primary" type="submit" value="Сохранить"/>
<a href="{{route('admin.person.index')}}" class="btn btn-outline-primary">Отмена</a>