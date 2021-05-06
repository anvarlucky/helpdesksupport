@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">@lang('table.custom')</strong> |
            <a href="{{route('projects.create',app()->getLocale())}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>@lang('table.otherName')</th>
                    <th>Url</th>
                    <th>@lang('table.programmer')</th>
                    <th>Ko'rsatish</th>
                    <th>O'zgartirish</th>
                    <th>O'chirish</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $key => $project)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$project->id}} </td>
                        <td><span >{{$project->name}}</span> </td>
                        <td><span >{{$project->url}}</span> </td>
                        <td><span>{{$project->firstname}} {{$project->lastname}}</span></td>
                        <td>
                            <a href="{{route('projects.show',$project->id)}}"><span class="fa fa-window-maximize"></span></a>
                        </td>
                        <td>
                            <a href="{{route('projects.edit',$project->id)}}"> <span class="fa fa-edit"></span></a>
                        </td>
                        <td>
                            {{--<a href="{{route('users.delete',$user->id)}}"> <span class="fa fa-remove"></span></a>--}}
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['projects.destroy', $project->id]
                            ]) !!}
                            <button class="fa fa-remove" type="submit" onclick="return confirm('Quyidagi foydalanuvchi {{$project->name}}ni o`chirmoqchimisiz?')"></button>
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



