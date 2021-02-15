@extends('client.layouts.main')
@section('content')
    Tiket id:<p>{{$ticket->id}}</p>
    Tiket mavzu:<p>{{$ticket->title}}</p>
    Ticket matn:<p>{{$ticket->description}}</p>
    Muammo rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot}}" height="300" width="400"><br>
    @if($ticket->status==2)
    Javob matni:<p>{{$ticket->description_to_client}}</p>
    Javob rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot_to_client}}" height="300" width="400"><br>
    Javob deadline:<p>{{$ticket->deadline}}</p>
    @endif
@endsection