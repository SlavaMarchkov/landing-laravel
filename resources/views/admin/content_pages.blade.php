<div style="margin: 0 20px;">
    @if($pages)
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Алиас</th>
                <th>Заголовок</th>
                <th>Контент</th>
                <th>Дата создания</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $key => $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{!! Html::link(route('pagesEdit', ['page' => $page->id]), $page->name, ['title' => 'Редактировать']) !!}</td>
                    <td>{{ $page->alias }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->text }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>
                        {!! Form::open([
                        'url' => route('pagesEdit', ['page' => $page->id]),
                        'class' => 'form-horizontal',
                        'method' => 'post',
                        ]) !!}
                        {!! Form::hidden('action', 'delete') !!}
                        {!! Form::button('Удалить', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    {!! Html::link(route('pagesAdd'), 'Добавить страницу', ['class' => 'btn btn-primary']) !!}
</div>