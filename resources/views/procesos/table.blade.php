<!--- Name Field --->
        <div class="form-group col-sm-4">
            {!! Form::label('title', 'Nombres:') !!}
            <input class="form-control" required name="title" type="text" id="title" id="nombreProceso2" onFocus="javascript:this.value=''">
        </div>
        
 <!--- Name Field --->
        <div class="form-group col-sm-4">
            {!! Form::label('numero', 'Tiempo:') !!}
           <input class="form-control" name="numero" required type="number" id="duracionProceso2" min="1" max="999" >
        </div>
        
<!-- Submit Field -->

<div class="form-group col-sm-12">
    <input class="btn btn-primary btn-ejecutar"  id="ingresarProceso" type="submit" value="Ingresar Tarea" onclick="enviar();" >
</div>

<table class="table" id="tablaProcesos">
    <thead>
    <th>Id</th>
	<th>Nombre</th>
	<th>Tiempo</th>
    <th width="100px">Action</th>
    </thead>
    <tbody id="listaProceso">
       
    @foreach($procesos as $proceso)
        <tr>
            <td>{!! $proceso->id !!} </td>
     	 	<td>{!! $proceso->title !!}</td>
     	 	<td>{!! $proceso->numero !!}</td>
            <td>
                <a href="{!! route('procesos.edit', [$proceso->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('procesos.delete', [$proceso->id]) !!}" onclick="return confirm('Are you sure wants to delete this Proceso?')"><i class="glyphicon glyphicon-remove"></i></a>
                <a href=""><span class="glyphicon glyphicon-refresh btn-proceso"></span></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('script')
<script src="control.js"></script>
@endsection