<div class="wrapper container-fluid" style="margin-bottom: 80px;">
    {!! Form::open([
    'url' => route('pagesEdit', ['page' => $data['id']]),
    'class' => 'form-horizontal',
    'method' => 'post',
    'enctype' => 'multipart/form-data'
    ]) !!}
    {!! Form::hidden('id', $data['id']) !!}
    {!! Form::hidden('old_images', $data['images']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Имя страницы', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-8">
            {!! Form::text('name', $data['name'], ['class' => 'form-control', 'placeholder' => 'Введите имя страницы, напр. contact']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('alias', 'Алиас страницы', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-8">
            {!! Form::text('alias', $data['alias'], ['class' => 'form-control', 'placeholder' => 'Введите алиас страницы, напр. contact']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('title', 'Заголовок страницы', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-8">
            {!! Form::text('title', $data['title'], ['class' => 'form-control', 'placeholder' => 'Введите заголовок страницы, напр. Контакты']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('text', 'Контент', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-8">
            {!! Form::textarea('text', $data['text'], ['id' => 'editor', 'class' => 'form-control', 'placeholder' => 'Введите контент']) !!}
        </div>
    </div>
    @if($data['images'])
        <div class="form-group">
            {!! Form::label('old_images', 'Текущее изображение', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-offset-2 col-md-10" style="margin-top: -20px;">
                {!! Html::image('assets/img/' . $data['images'], '', ['class' => 'img-thumbnail', 'width' => 200, 'height' => 200]) !!}
            </div>
        </div>
    @endif
    <div class="form-group">
        {!! Form::label('images', 'Изображение', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-8">
            {!! Form::file('images', [
            'class' => 'filestyle',
            'data-buttonText' => 'Выберите изображение',
            'data-buttonName' => 'btn-success',
            'data-placeholder' => 'Файла нет'
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        CKEDITOR.replace('editor');
    </script>
</div>