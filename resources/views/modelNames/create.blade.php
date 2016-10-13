@extends('layouts.app')

@section('content')
<div class="container">

   

    {!! Form::open(['route' => 'modelNames.store']) !!}

        @include('modelNames.fields')

    {!! Form::close() !!}
</div>
@endsection
