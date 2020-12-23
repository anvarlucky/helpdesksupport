@foreach($users as $key => $user)
    {{++$key}}|{{$user->firstname}}<br/>
@endforeach