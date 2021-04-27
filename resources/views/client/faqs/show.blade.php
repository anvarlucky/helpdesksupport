@extends('client.layouts.main')
@section('content')
    FAQ mavzu:<p>{{$faq->title}}</p>
    FAQ matn:<p>{{$faq->text}}</p>
    @if($faq->file != null)
        FAQ video:<br/>
            <video width="400" height="300" controls>
                <source src="/storage/faq/file/{{$faq->file}}">
            </video>
    @endif
@endsection