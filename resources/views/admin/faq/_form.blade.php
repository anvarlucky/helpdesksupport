<div class="form-group">
    <br/>
    <br><label>Dasturni tanlang:</label>
    {{Form::select('project_id', [__(' ')]+Arr::pluck($projects,'name','id'),$faq->project_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
    <label>Faq nomi</label>
    {{Form::text('title[uz]', $faq->title_uz??null, ['class' => 'form-control'])}}
    <label>Название Faq</label>
    {{Form::text('title[ru]', $faq->title_ru??null, ['class' => 'form-control'])}}
    <label>Name of Faq</label>
    {{Form::text('title[en]', $faq->title_en??null, ['class' => 'form-control'])}}
    <label>Faq Matni</label>
    {{Form::textarea('text[uz]', $faq->text_uz??null, ['class' => 'form-control'])}}
    <label>Faq Tekst</label>
    {{Form::textarea('text[ru]', $faq->text_ru??null, ['class' => 'form-control'])}}
    <label>Faq Text</label>
    {{Form::textarea('text[en]', $faq->text_en??null, ['class' => 'form-control'])}}
    <br/>
    <label>Muammo fayli</label>
    {{Form::file('file', null, ['class' => 'form-control'])}}
</div>