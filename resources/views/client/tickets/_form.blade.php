<div class="form-group col-md-12">
    <br/>
    <label>Sarlavha</label>
    {{Form::text('title', $ticket->title??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo</label>
    {{Form::textarea('description', $ticket->description??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo rasmi</label>
    {{Form::file('screenshot', $ticket->screenshot??null, ['class' => 'form-control'])}}
    <br><label>Dasturni tanlang:</label>
    {{Form::select('project_id', [__(' ')]+Arr::pluck($projects,'name','id'),$ticket->project_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
    <br><label>Kategoriyani tanlang:</label>
    {{Form::select('category_id', [__(' ')]+Arr::pluck($categories,'name','id'),$ticket->category_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
</div>
