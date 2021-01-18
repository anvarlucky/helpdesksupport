<div class="form-group col-md-12">
    <br/>
    <label>Proyekt nomi</label>
    {{Form::text('name', $project->name??null, ['class' => 'form-control'])}}
    <label>Proyekt url</label>
    {{Form::text('url', $project->url??'http://', ['class' => 'form-control'])}}
    <br><label>Masulni tanlang:</label>
    {{Form::select('user_id', [__(' ')]+Arr::pluck($users,'firstname','id'),$project->user_id??null, ['class' => 'form-control'])}}
</div>
