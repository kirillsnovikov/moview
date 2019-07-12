<div class="form-group">
    <label for="">Статус</label>
    <select class="form-control" name="published">

        @if (isset($genre->id))

        <option value="0" @if($genre->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if($genre->published == 1) selected="" @endif>Опубликовано</option>

        @else

        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>

        @endif

    </select>
</div>

<div class="form-group">
    <label for="">Название</label>
    <input class="form-control" type="text" placeholder="Заголовок жанра" name="title" value="{{$genre->title ?? old('title') ?? ''}}" required/>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input class="form-control" type="text" name="slug"
        @isset($genre->slug)
            placeholder="Slug"
            value="{{$genre->slug or 'err'}}"
            readonly
        @endisset
        placeholder="Slug"
        value="{{$genre->slug ?? old('slug') ?? ''}}"
    />
</div>      

<div class="form-group">
    <label for="">Тип</label>
    <select class="form-control" name="types[]" multiple>

        <!--<option value="0">Без родительской категории</option>-->

        @include('admin.genre.particles.types')

    </select>
</div>

<input class="btn btn-primary" type="submit" value="Сохранить"/>
<a href="{{route('admin.genre.index')}}" class="btn btn-outline-primary">Отмена</a>