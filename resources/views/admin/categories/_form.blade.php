<div class="form-group col-md-12">
    <br/>
    <label>Kategoriya nomi</label>
    {{Form::text('name[uz]', $category->name['uz']??null, ['class' => 'form-control'])}}
    <label>Название Категории</label>
    {{Form::text('name[ru]', $category->name['ru']??null, ['class' => 'form-control'])}}
    <label>Name of Category</label>
    {{Form::text('name[en]', $category->name['en']??null, ['class' => 'form-control'])}}
</div>
