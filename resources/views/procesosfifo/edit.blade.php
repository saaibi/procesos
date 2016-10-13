@extends('layouts.app')

@section('content')
<div class="container">
    
    {!! Form::model($procesos, ['route' => ['procesos.update', $procesos->id], 'method' => 'patch']) !!}
        @include('procesos.fields')
    {!! Form::close() !!}
</div>
@endsection
