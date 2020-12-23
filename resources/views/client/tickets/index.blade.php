@foreach($tickets as $key => $ticket)
    {{++$key}}|{{$ticket->title}}
@endforeach