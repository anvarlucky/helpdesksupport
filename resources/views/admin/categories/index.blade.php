@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">@lang('table.custom')</strong> |
            <a href="{{route('categories.create',app()->getLocale())}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>Kategoriya ID</th>
                    <th>Dastur</th>
                    <th>@lang('table.otherName')</th>
                    <th>Ko'rish</th>
                    <th>O'zgartirish</th>
                    <th>O'chirish</th>

                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$category->id}} </td>
                        <td>{{$category->project_name}}</td>
                        <td>  <span class="name">{{$category->name_uz}}</span> </td>
                        <td>
                            <a href="{{route('categories.show',$category->id)}}"><span class="fa fa-window-maximize"></span></a>
                        </td>
                        <td>
                            <a href="{{route('categories.edit',$category->id)}}"> <span class="fa fa-edit"></span></a>
                        </td>
                        <td>
                            {{--<a href="{{route('users.delete',$user->id)}}"> <span class="fa fa-remove"></span></a>--}}
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['categories.destroy', $category->id]
                            ]) !!}
                            <button class="fa fa-remove" type="submit" onclick="return confirm('Quyidagi foydalanuvchi {{$category->name_uz}}ni o`chirmoqchimisiz?')"></button>
                            {{--{!! Form::submit('', ['class' => 'fa fa-remove']) !!}--}}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection



