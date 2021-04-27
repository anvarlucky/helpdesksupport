@extends('client.layouts.main')
@section('content')
    <div class="card">
        <div class="table-stats order-table ov-h">
            <table class="table ">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>@lang('table.title')</th>

                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $key => $faq)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$faq->id}} </td>
                        <td><a href="{{route('faqclient.show',$faq->id)}}"><span class="name">{{$faq->title_uz??$faq->title}}</span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
@endsection
