<div class="container">
    {!! Form::open(['route' => 'projects.store','method' => 'post']) !!}
    @include('admin.projects._form')
    <button type="submit" class="btn adding-button ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>