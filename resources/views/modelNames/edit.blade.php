@extends('layouts.app')
@section('content')
<div class="container">

    

    {!! Form::model($modelName, ['route' => ['modelNames.update', $modelName->id], 'method' => 'patch']) !!}

        @include('modelNames.fields')

    {!! Form::close() !!}
</div>
@endsection
