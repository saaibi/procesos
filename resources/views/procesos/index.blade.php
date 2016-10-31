@extends('layouts.app')

@section('content')
    <div class="container">
      
        @include('flash::message')
         
        <div class="row">
            @if($procesos->isEmpty())
                <div class="well text-center">No Procesos found.</div>
                <div class="well text-center">Ingresa un nuevo procesos</div>
              @include('procesos.create')
            @else
                @include('procesos.create')
            @endif
        </div>
        
    </div>
@endsection

