@extends('admin.layouts.main')
@section('content')
    <p><b>Foydalanuvchi ismi:</b> {{$user->firstname}}</p>
    <p><b>Foydalanuvchi Familiyasi:</b> {{$user->lastname}}</p>
    <p><b>Foydalanuvchi Otasining ismi:</b> {{$user->surname}}</p>
    <p><b>Foydalanuvchi tel.raqami:</b> {{$user->phone}}</p>
    <p><b>Foydalanuvchi e-maili:</b> {{$user->email}}</p>
    <p><b>Foydalanuvchi roli:</b> {{$user->role_id}}</p>
    <p><b>Foydalanuvchi yaratilgan vaqti:</b> {{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d h:i:s')}}</p>
    {!!link_to(route('users.index'),'Back')!!}
    {{--@if($user->projects != null)
        @foreach($user->projects as $project)
                <p>{{$project->name}}</p>
    @endforeach
    @endif--}}
@endsection