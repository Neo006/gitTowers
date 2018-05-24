@extends('layouts.app')

@section('stylesheets')
    
    <style>
        .tower_edit img {
            width: 100px;
        }
    </style>
   
@endsection

@section('content')

    <div class="col-md-12 mt-5 towers_ed_des_block">
        <div class="mb-5">
            <a href="{{ route('tower.editDestroy') }}" class="btn btn-warning">< back</a>
        </div>
 
        <div class="row tower_edit">
            <div class="col-md-12 text-center">
                <img src="/images/RadioTower.png" alt="tower-img">
                <form action="{{ route('tower.update') }}" method="post">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="id" value="{{ $tower->id }}">
                    <label class="d-block">Name
                        <input type="text" name="name" class="form-control" value="{{ $tower->name }}">
                    </label>
                    <label>Description
                        <textarea name="description" cols="100%" rows="5" class="form-control d-block">{{ $tower->description }}</textarea>
                    </label>
                    <h3>Cordinates</h3>
                    <label>X_axis
                        <input type="text" name="x_axis" class="form-control" placeholder="from 0 to 90" value="{{ $tower->x_axis }}">
                    </label>
                    <label>Y_axis
                        <input type="text" name="y_axis" class="form-control" placeholder="from 0 to 180" value="{{ $tower->y_axis }}">
                    </label>
                    <div>
                        <input type="submit" value="Save" class="btn btn-success pl-5 pr-5">
                    </div>
                </form>
            </div>
        </div>
                
    </div>

@endsection

