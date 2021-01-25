@extends('admin.layouts.main')
@section('content')
<div class="container">
    {!! Form::open(['route' => 'users.store','method' => 'post']) !!}
    @include('admin.users._form')
    <button type="submit" class="btn btn-primary adding-button ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
@endsection