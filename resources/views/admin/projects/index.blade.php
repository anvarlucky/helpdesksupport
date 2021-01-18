@foreach($projects as $key => $project)
    {{++$key}}|{{$project->name}}<br/>
@endforeach