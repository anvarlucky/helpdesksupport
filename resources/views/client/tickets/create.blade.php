<div class="container">
    {!! Form::open(['route' => 'tickets.store','method' => 'post','files'=>true]) !!}
    @include('client.tickets._form')
    <button type="submit" class="btn adding-button ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>