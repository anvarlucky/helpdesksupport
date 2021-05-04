@extends('client.layouts.main')
@section('content')
    <div class="container col-12">
        <p><b>Tiket id:</b>{{$ticket->id}} | <b>Vaqti:</b> {{\Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d h:i:s')}} |<b>Kim tomonidan:</b> {{$ticket->fname}} {{$ticket->lname}}</p>
    Tiket mavzu:<p>{{$ticket->title}}</p>
    Ticket matn:<p>{{$ticket->description}}</p>
    @if($ticket->screenshot != null)
    Muammo rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot}}" height="300" width="400"><br><br/>
    @endif
        @foreach($comments as $comment)
        <h6>{{$comment->user->firstname}} {{$comment->user->lastname}}</h6>
        <p>{{$comment->comment}}  |  {{$comment->created_at}} </p>
        @endforeach
        @if($ticket->status !=3)
        {!! Form::open(['route' => ['comments.store',app()->getLocale()],'method' => 'post']) !!}
        @csrf
        @if (isset($user))
            {!! Form::hidden('user_id', $user) !!}
            {!! Form::hidden('ticket_id', $route1) !!}
        @endif
        <br>
        <label>Komment:</label>
        {{Form::textarea('comment', null, ['class' => 'form-control'])}}
        <br>
            <button type="submit" class="btn btn-primary ml-3">Saqlash</button>
            {!! Form::close() !!}
        @endif
    </div>
@endsection