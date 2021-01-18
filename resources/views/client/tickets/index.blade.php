@foreach($tickets as $key => $ticket)
    {{++$key}}|{{$ticket->title}}|<br>
@endforeach