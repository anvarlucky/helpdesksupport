<div class="form-group col-md-12">
    <label>Darajasi:</label>
    {{Form::select('priority', [''=>'','1' => 'Oddiy', '2' => 'O`rtacha muhum', '3' => 'Juda muhum'], $ticet->priority??null,['class' => 'form-control'])}}
    <br><label>Kategoriyani tanlang:</label>
    {{Form::select('category_id', [__(' ')]+Arr::pluck($categories,'name_uz','id'),$ticket->category_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
    <br/>
    <label>Sarlavha</label>
    {{Form::text('title', $ticket->title??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo</label>
    {{Form::textarea('description', $ticket->description??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo rasmi</label>
    {{Form::file('screenshot', $ticket->screenshot??null, ['class' => 'form-control'])}}
    <br>
</div>
