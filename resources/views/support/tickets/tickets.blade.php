@extends('programmer.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Custom Table</strong> |
            <a href="{{route('ticks2.create',[$project->id,app()->getLocale()])}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Prioritet</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $key => $ticket)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$ticket->id}} </td>
                        <td><a href="{{route('ticks2.show',[$project->id,$ticket->id])}}"><span class="name">{{$ticket->title}}</span></a></td>
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
                            <td><span class="btn btn-danger">Open</span></td>
                        @elseif($ticket->status==2)
                            <td><span class="btn btn-primary">Answered</span></td>
                        @else
                            <td><span class="btn btn-success">@lang('table.closed')</span></td>
                        @endif
                        <td><a href="{{--{{route('tickets.edit',[/*app()->getLocale(),*/$ticket->id])}}--}}" class="btn btn-success">Answer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection