@extends('admin.layouts.main')
@section('content')
<div class="container col-12">
    {!! Form::open(['route' => ['ticket.store',app()->getLocale()],'method' => 'post','files'=>true]) !!}
    @csrf
    @if (isset($user))
        {!! Form::hidden('client_id', $user) !!}
    @endif
    @include('admin.tickets._form')
    <button type="submit" class="btn btn-primary ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
@endsection