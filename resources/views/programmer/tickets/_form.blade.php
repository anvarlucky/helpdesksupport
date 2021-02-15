<div class="form-group">
    <label for="">Izoh</label>
    {{Form::textarea('description_to_client', $ticket->description_to_client??null, ['class' => 'form-control'])}}
</div>
<label>Muammo rasmi <b>Fayl yuklash shart!</b></label>
{{Form::file('screenshot_to_client', $ticket->screenshot_to_client??null, ['class' => 'form-control'])}}
<br>
<label>Sana</label>
{{Form::date('deadline', $ticket->deadline??null, ['class' => 'form-control'])}}
<br>