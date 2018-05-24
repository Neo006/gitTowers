@extends('layouts.app')

@section('stylesheets')
    
   <style>
        .tower_ed_des img {
            width: 60px;
        }
   </style>

@endsection

@section('content')

    <div class="col-md-12 mt-5 towers_ed_des_block">
        <div class="mb-5">
            <a href="{{ route('home') }}" class="btn btn-warning">< back to home</a>
        </div>

        @if (Session::has('success'))

            <div class="alert alert-success" role="alert">
                <strong>Success:</strong> {{ Session::get('success') }}
            </div>

        @endif

        @if (Session::has('error_message'))

            <div class="alert alert-danger" role="alert">
                <strong>Error:</strong> {{ Session::get('error_message') }}
            </div>

        @endif

        @foreach ($towers as $tower)
            
                <div class="row tower_ed_des">
                    <div class="col-md-2 text-center">
                        <img src="/images/RadioTower.png" alt="tower-img">
                        <p>{{ $tower->name }}</p>
                    </div>
                    <div class="col-md-6 mt-3">
                        <a href="{{ route('tower.edit', $tower->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('tower.destroy', $tower->id) }}" class="btn btn-danger">Destroy</a>
                    </div>
                </div>
                
        @endforeach
    </div>

@endsection

