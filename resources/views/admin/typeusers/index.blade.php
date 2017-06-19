@extends('admin.template.main')

@section('title','Lista de Tipos de Usuarios')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TIPOS DE USUARIOS</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.typeusers.create') }}" class="btn btn-info">Registrar Tipo Usuario</a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Tipo Usuario</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($typesusers as $typeuser)
							<tr>
								<td>{{ $typeuser->id}}</td>
								<td>{{ $typeuser->name }}</td>
								<td>
									<a href="{{ route('admin.typeusers.edit', $typeuser->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="{{ route('admin.typeusers.destroy', $typeuser->id) }}" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $typesusers->render() !!}
			</div>
		</div>		
</div>
@endsection