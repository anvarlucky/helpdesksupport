@extends('programmer.layouts.main')
@section('content')
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                @foreach($project as $proj)
                <div class="col-lg-3 col-md-6">
                    <a href="{{route('ticks2.ticket',$proj->id)}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-ticket"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span>{{$proj->name}}</span></div>
                                        <div class="stat-heading">Barcha ticketlar</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="clearfix"></div>
            <!-- Orders -->
            <!-- /.orders -->
            <!-- To Do and Live Chat -->
            <!-- /#add-category -->
        </div>
        <!-- .animated -->
    </div>
@endsection