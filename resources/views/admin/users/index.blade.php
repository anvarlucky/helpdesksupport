@extends('admin.layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">Custom Table</strong> |
        <a href="{{route('users.create')}}">Yangi foydalanuvchi qo'shish</a>
    </div>
    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Tel.raqam</th>
                <th>Status</th>
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
                <td>
                    @if($user->deleted_at==null)
                    <span class="badge badge-complete">Active</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- /.table-stats -->
</div>


@endsection
