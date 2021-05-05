@extends('admin.layouts.main')
@section('content')
    <p><b>Dastur nomi:</b> {{$project->name}}</p>
    <a>Dastur sahifasi: {{$project->url}}</a>
    <p><b>Dastur yaratilgan vaqti:</b> {{\Carbon\Carbon::parse($project->created_at)->format('Y-m-d h:i:s')}}</p>
@endsection