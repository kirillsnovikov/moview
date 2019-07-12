<div class="form-group row">
    <div class="col-6">
        <label for="">Статус</label>
        <select class="form-control" name="published">

            @if (isset($movie->id))

            <option value="0" @if($movie->published == 0) selected="" @endif>Не опубликовано</option>
            <option value="1" @if($movie->published == 1) selected="" @endif>Опубликовано</option>

            @else

            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>

            @endif

        </select>
    </div>
    <div class="col-6">
        <label for="">Постер</label>
        <input class="form-control-file" type="file" name="image" value="{{$movie->image_name ?? old('image_name') ?? ''}}"/>
    </div>
</div>

<div class="form-group row">
    <div class="col-6">
        <label for="">Название фильма</label>
        <input class="form-control" type="text" placeholder="Название фильма" name="title" value="{{$movie->title ?? old('title') ?? ''}}" required/>
    </div>
    <div class="col-6">
        <label for="">Название оригинал</label>
        <input class="form-control" type="text" placeholder="Оригинальное название (если есть)" name="original_title" value="{{$movie->original_title ?? old('original_title') ?? ''}}"/>
    </div>
</div>

<div class="form-group row">
    <div class="col-6">
        <label class="col-form-label" for="">KP_raiting</label>
        <input class="form-control" type="number" placeholder="Рейтинг КП" name="kp_raiting" min="10000" max="99999" step="1" placeholder="1" value="{{$movie->kp_raiting ?? old('kp_raiting') ?? ''}}"/>
    </div>
    <div class="col-6">
        <label class="col-form-label" for="">ImDB_raiting</label>
        <input class="form-control" type="number" placeholder="Рейтинг ImDB" name="imdb_raiting" min="10000" max="99999" step="1" placeholder="1" value="{{$movie->imdb_raiting ?? old('imdb_raiting') ?? ''}}"/>
    </div>
</div>

<div class="form-group row">
    <div class="col-4">
        <label class="col-form-label" for="">Год выпуска</label>
        <input class="form-control" type="date" placeholder="Год" name="premiere" value="{{$movie->premiere ?? old('premiere') ?? ''}}"/>
    </div>
    <div class="col-4">
        <label class="col-form-label" for="">Продолжительность</label>
        <input class="form-control" type="number" placeholder="Минуты" name="duration" min="1" max="2100" step="1" value="{{$movie->duration ?? old('duration') ?? ''}}"/>
    </div>
    <div class="col-4">
        <label class="col-form-label" for="">ID Кинопоиска</label>
        <input class="form-control" type="number" placeholder="Номер" name="kp_id" min="1" step="1" value="{{$movie->kp_id ?? old('kp_id') ?? ''}}"/>
    </div>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input class="form-control" type="text" placeholder="Автоматическая генерация" name="slug" value="{{$movie->slug ?? old('slug') ?? ''}}" readonly/>
</div>

<div class="form-group row">
    <div class="col-6">
        <label for="">Тип</label>
        <select class="form-control" name="type_id">

            @include('admin.movie.particles.types')

        </select>
        <label for="">Жанры</label>
        <select class="form-control" name="genres[]" multiple>

            @include('admin.movie.particles.genres')

        </select>
    </div>
    <div class="col-6">
        <label for="">Страна</label>
        <select class="form-control" name="countries[]" multiple>

            @include('admin.movie.particles.countries')

        </select>
    </div>
</div>

<div class="form-group">
    <label for="">Краткое описание</label>
    <textarea  class="form-control" name="description_short" id="description_short">{{$movie->description_short ?? old('description_short') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="">Описание</label>
    <textarea  class="form-control" name="description" id="description" rows="7">{{$movie->description ?? old('description') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="">Мета заголовок</label>
    <input class="form-control" type="text" placeholder="Мета заголовок" name="meta_title" value="{{$movie->meta_title ?? old('meta_title') ?? ''}}"/>
</div>

<div class="form-group">
    <label for="">Мета описание</label>
    <input class="form-control" type="text" placeholder="Мета описание" name="meta_description" value="{{$movie->meta_description ?? old('meta_description') ?? ''}}"/>
</div>

<div class="form-group">
    <label for="">Ключевые слова</label>
    <input class="form-control" type="text" placeholder="Ключевые слова" name="meta_keywords" value="{{$movie->meta_keywords ?? old('meta_keywords') ?? ''}}"/>
</div>

<input class="btn btn-primary" type="submit" value="Сохранить"/>
<a href="{{route('admin.movie.index')}}" class="btn btn-outline-primary">Отмена</a>