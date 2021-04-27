@extends('admin.layouts.main')
@section('content')
    <p><b>FAQ nomi:</b> {{$faq->title_uz}}</p>
    <p><b>FAQ Dasturi:</b> {{$faq->project_id}}</p>
    <p><b>FAQ Matni:</b> {{$faq->text_uz}}</p>
    <p><b>FAQ Fayli:</b> @if($faq->file != null)
            <video width="400" height="300" controls>
                <source src="/storage/faq/file/{{$faq->file}}">
            </video>
        @endif</p>
    {!!link_to(route('faq.index'),'Back')!!}
    {{--@if($user->projects != null)
        @foreach($user->projects as $project)
                <p>{{$project->name}}</p>
    @endforeach
    @endif--}}
@endsection