@extends('layouts.app')

@section('stylesheets')
    
   <style>
        .towers_block {
            position: relative;
        }
        .tower {
            position: absolute;
            width: 60px;
        }
        .tower a {
            cursor: pointer;
        }
   </style>

@endsection

@section('content')

    <div class="col-md-6 mt-2">
        <a href="#demo" class="btn btn-primary" data-toggle="collapse">Add Tower</a>
        <div id="demo" class="collapse">
            <form id="add_tower" action="#">
                {{ csrf_field() }}
                <label class="d-block">Name
                    <input type="text" name="name" class="form-control" id="name">
                </label>
                <label>Description
                    <textarea name="description" cols="100%" rows="3" class="form-control d-block" id="description"></textarea>
                </label>
                <h3>Cordinates</h3>
                <label>X_axis
                    <input type="text" name="x_axis" class="form-control" id="x_axis" placeholder="from 0 to 90">
                </label>
                <label>Y_axis
                    <input type="text" name="y_axis" class="form-control" id="y_axis" placeholder="from 0 to 180">
                </label>
                <div>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
            <hr>
        </div>
    </div>

    <div class="col-md-3 mt-2 search_bl">
        <a href="#demo2" class="btn btn-primary" data-toggle="collapse">Search</a>
        <div id="demo2" class="collapse">
            <form id="search" action="#" method="GET">
                {{ csrf_field() }}
                <label>X_axis
                    <input type="text" name="sr_x_axis" class="form-control" id="sr_x_axis" placeholder="from 0 to 90">
                </label>
                <label>Y_axis
                    <input type="text" name="sr_y_axis" class="form-control" id="sr_y_axis" placeholder="from 0 to 180">
                </label>
                <label>Radius
                    <input type="text" name="sr_radius" class="form-control" id="sr_radius">
                </label>
                <div>
                    <button class="btn btn-success">Enter</button>
                </div>
            </form>
            <hr>
        </div>
    </div>

    <div class="col-md-3 mt-2">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Dropdown button
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('home') }}">all towers</a>
                <a class="dropdown-item" href="{{ route('tower.editDestroy') }}">edit</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5 towers_block">
        @foreach ($towers as $tower)
            <div class="tower text-center" style="left: {{ 10 * ($tower->x_axis) }}px; top: {{ 2 * ($tower->y_axis) }}px">
                <a data-toggle="popover" data-content="{{ $tower->description }}"><img src="/images/RadioTower.png" alt="tower-img" class="w-100"></a>
                <p>{{ $tower->name }}</p>
            </div>
        @endforeach
    </div>



@endsection

@section('scripts')
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            // store request
            $('#add_tower').submit(function(event){
                event.preventDefault();

                var name = $('#name').val();
                var descr = $('#description').val();
                var x = $('#x_axis').val();
                var y = $('#y_axis').val();

                $.ajax({
                    url: "{{ route('tower.store') }}",
                    type: "POST",
                    data: {name:name,description:descr,x_axis:x,y_axis:y},
                    success: function (data) {
                        $('.towers_block').append('<div class="tower text-center" style="left:'+ data[2] * 10 +'px; top:'+ data[3] * 2 +'px">' + '<a data-toggle="popover" data-content="'+ data[1] +'"><img src="/images/RadioTower.png" alt="tower-img" class="w-100"></a>' + '<p>'+ data[0] +'</p>' + '</div>');
                        $('[data-toggle="popover"]').popover();
                    },
                    error: function (msg) {
                        alert('error');
                    }
                });
            });

            // search request
             $('#search').submit(function(event){
                event.preventDefault();
                $('.tower').remove();
               
                var sr_x_axis = $('#sr_x_axis').val();
                var sr_y_axis = $('#sr_y_axis').val();
                var sr_radius = $('#sr_radius').val();

                $.ajax({
                    url: "{{ route('tower.search') }}",
                    type: "GET",
                    data: {sr_x_axis:sr_x_axis,sr_y_axis:sr_y_axis,sr_radius,sr_radius},
                    success: function (data) {
                        $('.tower').remove();
                        for(var i = 0; i < data.length; i++) {
                            $('.towers_block').append('<div class="tower text-center" style="left:'+ data[i].x_axis * 10 +'px; top:'+ data[i].y_axis * 2 +'px">' + '<a data-toggle="popover" data-content="'+ data[i].description +'"><img src="/images/RadioTower.png" alt="tower-img" class="w-100"></a>' + '<p>'+ data[i].name +'</p>' + '</div>');
                            $('[data-toggle="popover"]').popover();
                        }
                        $('.result').remove();
                        $('.search_bl').append("<p class='result'> Result = " + data.length + "</p>");
                    },
                    error: function (msg) {
                        alert('error');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
        });
    </script>

@endsection