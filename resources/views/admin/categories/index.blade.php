@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Custom Table</strong> |
            <a href="{{route('categories.create')}}">Yangi Kategoriya qo'shish</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Name</th>

                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$category->id}} </td>
                        <td>  <span class="name">{{$category->name}}</span> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection



