@extends('admin.layouts.main')
@section('content')
<div class="container col-12">
    {!! Form::open(['route' => ['projects.store',app()->getLocale()],'method' => 'post']) !!}
    @include('admin.projects._form')
    <button type="submit" class="btn btn-primary ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
@endsection