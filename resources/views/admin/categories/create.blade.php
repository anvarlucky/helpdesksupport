@extends('admin.layouts.main')
@section('content')
<div class="container">
    {!! Form::open(['route' => 'categories.store','method' => 'post']) !!}
    @include('admin.categories._form')
    <button type="submit" class="btn btn-primary ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
@endsection