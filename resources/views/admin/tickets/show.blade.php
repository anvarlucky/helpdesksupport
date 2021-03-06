@extends('admin.layouts.main')
@section('content')
    <div class="col-12">
        @if($ticket->status !=3)
        {!! Form::open(['route' => ['ticket.close',$ticket->id],'method' => 'post']) !!}
        {!! Form::hidden('status', 3) !!}
        <button type="submit" class="btn btn-success ml-3">Ticketni Yopish</button>
        {!! Form::close() !!}
        @endif
            <p><b>Tiket id:</b>{{$ticket->id}} | <b>Vaqti:</b> {{\Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d h:i:s')}} |<b>Kim tomonidan:</b> @if($ticket->fullname == null){{$ticket->firstname }} {{ $ticket->lastname}}@else{{$ticket->fullname}}@endif</p>
    Tiket mavzu:<p>{{$ticket->title}}</p>
    Ticket matn:<p>{{$ticket->description}}</p>
    @if($ticket->screenshot != null)
    Muammo rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot}}" height="300" width="400"><br>
    @endif
    @if($ticket->status !=1)
        Javob matni:<p>{{$ticket->description_to_client}}</p>
            @if($ticket->screenshot_to_client != null)
            Javob rasmi:<br/><img src="/storage/ticket/photo/{{$ticket->screenshot_to_client}}" height="300" width="400"><br>
            @endif
            @if($ticket->deadline !=null)
            Javob deadline:<p>{{$ticket->deadline}}</p>
            @endif
    @endif
            <h3>Izohlar:</h3>
            <br/>
            @foreach($comments as $comment)
                <h6>{{$comment->firstname}} {{$comment->lastname}}</h6>
                <p>{{$comment->comment}}  |  {{\Carbon\Carbon::parse($comment->created_at)->format('Y-m-d h:i:s')}} </p>
            @endforeach
        @if($ticket->status !=3)
        {!! Form::open(['route' => ['comment.create',[$ticket->id,app()->getLocale()]],'method' => 'post']) !!}
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