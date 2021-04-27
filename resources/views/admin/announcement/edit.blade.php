@extends('admin.layouts.main')
@section('content')
    <div class="container col-12">
        {!! Form::open(['route' => ['announcement.update',[$announcement->id,app()->getLocale()]],'method' => 'put','files'=>true]) !!}
        @include('admin.announcement._form')
        <button type="submit" class="btn btn-primary adding-button ml-3">O'zgartirish</button>
        {!! Form::close() !!}
    </div>
@endsection