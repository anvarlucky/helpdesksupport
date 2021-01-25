@foreach($tickets as $key => $ticket)
    {{$ticket->id}}|{{$ticket->title}}<br/>
@endforeach