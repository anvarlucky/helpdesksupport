@foreach($categories as $key => $category)
    {{++$key}}|{{$category->name}}<br/>
@endforeach