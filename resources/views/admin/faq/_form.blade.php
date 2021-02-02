
<div class="form-group">
    <br/>
    <br><label>Dasturni tanlang:</label>
    {{Form::select('project_id', [__(' ')]+Arr::pluck($projects,'name','id'),$ticket->project_id??null, ['class' => 'form-control', 'id'=>'curse'])}}
    <label>Faq nomi</label>
    {{Form::text('title[uz]', $faq->title['uz']??null, ['class' => 'form-control'])}}
    <label>Название Faq</label>
    {{Form::text('title[ru]', $faq->title['ru']??null, ['class' => 'form-control'])}}
    <label>Name of Faq</label>
    {{Form::text('title[en]', $faq->title['en']??null, ['class' => 'form-control'])}}
    <label>Faq Matni</label>
    {{Form::textarea('text[uz]', $faq->text['uz']??null, ['class' => 'form-control'])}}
    <label>Faq Tekst</label>
    {{Form::textarea('text[ru]', $faq->text['ru']??null, ['class' => 'form-control'])}}
    <label>Faq Text</label>
    {{Form::textarea('text[en]', $faq->text['en']??null, ['class' => 'form-control'])}}
    <br/>
    <label>Muammo fayli</label>
    {{Form::file('file', $faq->file??null, ['class' => 'form-control'])}}
</div>