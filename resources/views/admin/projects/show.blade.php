@extends('admin.layouts.main')
@section('content')
    <p><b>Dastur nomi:</b> {{$project->name}}</p>
    <a>Dastur sahifasi: {{$project->url}}</a>
    <p><b>Dastur yaratilgan vaqti:</b> {{$project->created_at}}</p>
@endsection