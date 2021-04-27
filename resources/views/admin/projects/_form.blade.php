<div class="form-group col-md-12">
    <br/>
    <label>Proyekt nomi</label>
    {{Form::text('name', $project->name??null, ['class' => 'form-control'])}}
    <label>Proyekt url</label>
    {{Form::text('url', $project->url??'http://', ['class' => 'form-control'])}}
    <br><label>Dasturchini tanlang:</label>
    <select multiple class="form-control" id="exampleFormControlSelect2" name="users[]">
        @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->firstname}}</option>
        @endforeach
    </select>
</div>
