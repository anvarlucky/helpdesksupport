<div class="form-group">
    <label>Elon sanasi:</label>
    {{Form::date('date', $announcement->date??null, ['class' => 'form-control'])}}
    <br/>
    <label>Dasturni tanlang:</label>
    <select multiple class="form-control" id="exampleFormControlSelect2" name="projects[]">
        @foreach($projects as $project)
            <option value="{{$project->id}}">{{$project->name}}</option>
        @endforeach
    </select>
    <br/>
    <label>Elon nomi</label>
    {{Form::text('title', $announcement->title??null, ['class' => 'form-control'])}}
    <br/>
    <label>Elon</label>
    {{Form::textarea('text', $announcement->text??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo rasmi</label>
    {{Form::file('image', null, ['class' => 'form-control'])}}
    <br>
</div>