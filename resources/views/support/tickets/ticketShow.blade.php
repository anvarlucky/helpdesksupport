@extends('programmer.layouts.main')
@section('content')
    <div class="col-12">
        <p><b>Tiket id:</b>{{$ticket->id}} | <b>Vaqti:</b> {{$ticket->created_at}} |<b>Kim tomonidan:</b> {{$ticket->client_id}}</p>
        Tiket mavzu:<p>{{$ticket->title}}</p>
        Ticket matn:<p>{{$ticket->description}}</p>
        @if($ticket->screenshot != null)
            Muammo rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot}}" height="300" width="400"><br>
        @endif
        @if($ticket->status!=1)
            Javob matni:<p>{{$ticket->description_to_client}}</p>
            @if($ticket->screenshot_to_client != null)
                Javob rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot_to_client}}" height="300" width="400"><br>
            @endif
            @if($ticket->deadline !=null)
                Javob deadline:<p>{{$ticket->deadline}}</p>
            @endif
        @endif
        @foreach($comments as $comment)
            <h6>{{$comment->user->firstname}} {{$comment->user->lastname}}</h6>
            <p>{{$comment->comment}}  |  {{$comment->created_at}} </p>
        @endforeach
        @if($ticket->status !=3)
            {!! Form::open(['route' => ['comm1.store',app()->getLocale()],'method' => 'post']) !!}
            @csrf
            @if (isset($user))
                {!! Form::hidden('user_id', $user) !!}
                {!! Form::hidden('ticket_id', $routeId) !!}
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