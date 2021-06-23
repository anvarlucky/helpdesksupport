@extends('client.layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">@lang('table.custom')</strong> | <a href="{{route('ticks.create',app()->getLocale())}}">@lang('table.new')</a>
    </div>
    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th>ID</th>
                <th>@lang('table.title')</th>
                <th>@lang('table.project')</th>
                <th>Prioritet</th>
                <th>@lang('table.category')</th>
                <th>@lang('table.status')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets->data as $key => $ticket)
                @if($ticket != null)
                <tr>
                    <td class="serial">{{++$key}}</td>
                    <td> #{{$ticket->id}} </td>
                    <td><a href="{{route('ticks.show',[/*app()->getLocale(),*/$ticket->id])}}"><span class="name">{{$ticket->title}}</span></a></td>
                    <td> <span class="product">{{$ticket->project_id}}</span> </td>
                    @if($ticket->priority==1)
                        <td class="alert-primary"></td>
                    @elseif($ticket->priority==2)
                        <td class="alert-warning"></td>
                    @elseif($ticket->priority==3)
                        <td class="alert-danger"></td>
                    @else
                        <td></td>
                    @endif
                    <td><span class="count">{{$ticket->category_id}}</span></td>
                    @if($ticket->status==1)
                        <td><span class="btn btn-danger">@lang('table.open')</span></td>
                    @elseif($ticket->status==2)
                        <td><span class="btn btn-primary">Ish jarayonida</span></td>
                    @else
                        <td><span class="btn btn-success">@lang('table.closed')</span></td>
                    @endif
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div> <!-- /.table-stats -->
</div>
@endsection