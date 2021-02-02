@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Custom Table</strong> |
            <a href="{{route('faq.create')}}">Yangi FAQ qo'shish</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Title</th>

                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $key => $faq)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$faq->id}} </td>
                        <td>  <span class="name">{{$faq->title}}</span> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection



