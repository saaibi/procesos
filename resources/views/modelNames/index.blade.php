@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">ModelNames</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('modelNames.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($modelNames->isEmpty())
                <div class="well text-center">No ModelNames found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Title</th>
			<th>Password</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($modelNames as $modelName)
                        <tr>
                            <td>{!! $modelName->title !!}</td>
					<td>{!! $modelName->password !!}</td>
                            <td>
                                <a href="{!! route('modelNames.edit', [$modelName->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('modelNames.delete', [$modelName->id]) !!}" onclick="return confirm('Are you sure wants to delete this ModelName?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection