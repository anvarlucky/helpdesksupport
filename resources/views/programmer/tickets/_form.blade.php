<div class="form-group">
    <label for="">Izoh</label>
    {{Form::textarea('license_direction', $mauntaineering->license_direction??null, ['class' => 'form-control'])}}
</div>
<label>Muammo rasmi</label>
{{Form::file('image', $announcement->image??null, ['class' => 'form-control'])}}
<br>
<label>Sana</label>
{{Form::date('date', $announcement->date??null, ['class' => 'form-control'])}}
<br>