@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">@lang('table.custom')</strong> |
            <a href="{{route('faq.create',app()->getLocale())}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>@lang('table.title')</th>
                    <th>Ko'rish</th>
                    <th>O'zgartirish</th>
                    <th>O'chirish</th>

                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $key => $faq)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$faq->id}} </td>
                        <td>  <span class="name">{{$faq->title_uz}}</span> </td>
                        <td>
                            <a href="{{route('faq.show',$faq->id)}}"><span class="fa fa-window-maximize"></span></a>
                        </td>
                        <td>
                            <a href="{{route('faq.edit',$faq->id)}}"> <span class="fa fa-edit"></span></a>
                        </td>
                        <td>
                            {{--<a href="{{route('users.delete',$user->id)}}"> <span class="fa fa-remove"></span></a>--}}
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['faq.destroy', $faq->id]
                            ]) !!}
                            <button class="fa fa-remove" type="submit" onclick="return confirm('Quyidagi foydalanuvchi {{$faq->title}}ni o`chirmoqchimisiz?')"></button>
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



