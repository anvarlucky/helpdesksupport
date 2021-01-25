@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Custom Table</strong> |
            <a href="{{route('projects.create')}}">Yangi Dastur qo'shish</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Dasturchi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $key => $project)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$project->id}} </td>
                        <td>  <span class="name">{{$project->name}}</span> </td>
                        <td> <span class="product">{{$project->url}}</span> </td>
                        <td><span class="count">{{$project->user_id}}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection



