@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Custom Table</strong> |
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Category</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $key => $ticket)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$ticket->id}} </td>
                        <td>  <span class="name">{{$ticket->title}}</span> </td>
                        <td> <span class="product">{{$ticket->project_id}}</span> </td>
                        <td><span class="count">{{$ticket->category_id}}</span></td>
                        @if($ticket->status==1)
                        <td><span class="btn btn-danger">Open</span></td>
                        @elseif($ticket->status==2)
                        <td><span class="btn btn-primary">Answered</span></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection



