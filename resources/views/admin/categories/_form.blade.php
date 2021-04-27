
<div class="form-group">
    <br/>
    <label>Dasturni tanlang:</label>
    {{Form::select('project_id', [__(' ')]+Arr::pluck($projects,'name','id'),$category->project_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
    <br/>
    <label>Kategoriya nomi</label>
    {{Form::text('name[uz]', $category->name_uz??null, ['class' => 'form-control'])}}
    <label>Название Категории</label>
    {{Form::text('name[ru]', $category->name_ru??null, ['class' => 'form-control'])}}
    <label>Name of Category</label>
    {{Form::text('name[en]', $category->name_en??null, ['class' => 'form-control'])}}
</div>