@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Sarlavha orqali qidirish">
            <strong class="card-title">@lang('table.custom')</strong> |
            <a href="{{route('ticket.create',app()->getLocale())}}">@lang('table.new')</a>
        </div>
        <div class="table-stats order-table ov-h">
            <table id="myTable">
                <thead>
                <tr class="header">
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
                @foreach($tickets as $key => $ticket)
                    <tr>
                        <td class="serial">{{++$key}}</td>
                        <td> #{{$ticket->id}} </td>
                        <td><a href="{{route('ticket.show',[/*app()->getLocale(),*/$ticket->id])}}">  <span class="name">{{$ticket->title}}</span></a> </td>
                        <td> <span class="product">{{$ticket->project_name}}</span> </td>
                        @if($ticket->priority==1)
                            <td class="alert-primary"></td>
                        @elseif($ticket->priority==2)
                            <td class="alert-warning"></td>
                        @elseif($ticket->priority==3)
                            <td class="alert-danger"></td>
                        @else
                            <td></td>
                        @endif
                        <td><span>{{$ticket->category_name}}</span></td>
                        @if($ticket->status==1)
                        <td><span class="btn btn-danger">@lang('table.open')</span></td>
                        @elseif($ticket->status==2)
                        <td><span class="btn btn-primary">@lang('table.answered')</span></td>
                        @else
                        <td><span class="btn btn-success">@lang('table.closed')</span></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
    <style>
        #myInput {
            background-image: url('/css/searchicon.png'); /* Add a search icon to input */
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        #myTable {
            border-collapse: collapse; /* Collapse borders */
            width: 100%; /* Full-width */
            border: 1px solid #ddd; /* Add a grey border */
            font-size: 18px; /* Increase font-size */
        }

        #myTable th, #myTable td {
            text-align: left; /* Left-align text */
            padding: 12px; /* Add padding */
        }

        #myTable tr {
            /* Add a bottom border to all table rows */
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
            /* Add a grey background color to the table header and on hover */
            background-color: #f1f1f1;
        }
    </style>

    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection



