@extends('admin.layouts.main')
@section('content')
    <p><b>Elon nomi:</b> {{$announcement->title}}</p>
    <p><b>Elon Matni:</b> {{$announcement->text}}</p>
    <p><b>Elon Fayli:</b> @if($announcement->image != null)
            <video width="400" height="300" controls>
                <source src="/storage/announcement/file/{{$announcement->image}}">
            </video>
        @endif</p>
    {!!link_to(route('announcement.index'),'Back')!!}
    {{--@if($user->projects != null)
        @foreach($user->projects as $project)
                <p>{{$project->name}}</p>
    @endforeach
    @endif--}}
@endsection