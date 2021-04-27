@extends('admin.layouts.main')
@section('content')
    <p><b>Kategoriya nomi:</b> {{$category->name}}</p>
    <p><b>Kategoriya Dasturi:</b> {{$category->project_id}}</p>
    {!!link_to(route('categories.index'),'Back')!!}
    {{--@if($user->projects != null)
        @foreach($user->projects as $project)
                <p>{{$project->name}}</p>
    @endforeach
    @endif--}}
@endsection