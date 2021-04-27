@extends('admin.layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">@lang('table.custom')</strong> |
        <a href="{{route('users.create',app()->getLocale())}}">@lang('table.new')</a>
    </div>
    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th>ID</th>
                <th>@lang('table.name')</th>
                <th>@lang('table.mail')</th>
                <th>@lang('table.phone')</th>
                {{--<th>@lang('table.status')</th>--}}
                <th>Ko'rsatish</th>
                <th>O'zgartirish</th>
                <th>O'chirish</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td class="serial">{{++$key}}</td>
                <td> #{{$user->id}} </td>
                <td>  <span class="name">{{$user->firstname}}</span> </td>
                <td> <span class="product">{{$user->email}}</span> </td>
                <td><span class="count">{{$user->phone}}</span></td>
{{--                <td>
                    @if($user->deleted_at==null)
                        <span class="badge badge-complete">Active</span>
                    @endif
                </td>--}}
                <td>
                    <a href="{{route('users.show',$user->id)}}"><span class="fa fa-window-maximize"></span></a>
                </td>
                <td>
                    <a href="{{route('users.edit',$user->id)}}"> <span class="fa fa-edit"></span></a>
                </td>
                <td>
                    {{--<a href="{{route('users.delete',$user->id)}}"> <span class="fa fa-remove"></span></a>--}}
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['users.destroy', $user->id]
                    ]) !!}
                    <button class="fa fa-remove" type="submit" onclick="return confirm('Quyidagi foydalanuvchi {{$user->firstname}}ni o`chirmoqchimisiz?')"></button>
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
