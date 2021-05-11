@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">@lang('table.custom')</strong> |
            <a href="{{route('announcement.create',app()->getLocale())}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>Elon ID</th>
                    <th>Elon mavzu</th>
                    <th>Dastur</th>
                    <th>Ko'rish</th>
                    <th>O'zgartirish</th>
                    <th>O'chirish</th>

                </tr>
                </thead>
                <tbody>
                @foreach($announcements as $key => $announcement)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$announcement->id}} </td>
                        <td>{{$announcement->title}}</td>
                        <td>{{$announcement->project_name}}</td>
                        <td>
                            <a href="{{route('announcement.show',$announcement->id)}}"><span class="fa fa-window-maximize"></span></a>
                        </td>
                        <td>
                            <a href="{{route('announcement.edit',$announcement->id)}}"> <span class="fa fa-edit"></span></a>
                        </td>
                        <td>
                            {{--<a href="{{route('users.delete',$user->id)}}"> <span class="fa fa-remove"></span></a>--}}
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['announcement.destroy', $announcement->id]
                            ]) !!}
                            <button class="fa fa-remove" type="submit" onclick="return confirm('Quyidagi foydalanuvchi {{$announcement->title}}ni o`chirmoqchimisiz?')"></button>
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



