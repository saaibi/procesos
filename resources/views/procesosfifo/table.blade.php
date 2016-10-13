<table class="table">
    <thead>
    <th>Id</th>
	<th>Nombre</th>
	<th>Tiempo</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>

    @foreach($procesos as $proceso)
        <tr>
            <td>{!! $proceso->id !!}</td>
     	 	<td>{!! $proceso->title !!}</td>
     	 	<td>{!! $proceso->numero !!}</td>
            <td>
                <a href="{!! route('procesos.edit', [$proceso->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('procesos.delete', [$proceso->id]) !!}" onclick="return confirm('Are you sure wants to delete this Proceso?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
        
    @endforeach
    </tbody>
</table>
