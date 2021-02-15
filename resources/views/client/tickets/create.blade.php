@extends('client.layouts.main')
@section('content')
<div class="container col-12">
    {!! Form::open(['route' => 'ticks.store','method' => 'post','files'=>true]) !!}
    @csrf
    @if (isset($user))
        {!! Form::hidden('user_id', $user) !!}
    @endif
    @include('client.tickets._form')
    <button type="submit" class="btn btn-primary ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
@endsection