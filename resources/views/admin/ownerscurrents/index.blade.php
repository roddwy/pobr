@extends('admin.template.main')

@section('title','Lista de Propietarios')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODOS LOS PROPIETARIOS</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.ownerscurrents.create') }}" class="btn btn-info">Registrar un nuevo Propietario</a>
			<!--BUSCADOR DE PROPIETARIOS-->
			{!! Form::open(['route'=>'admin.ownerscurrents.index', 'method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
				<div class="input-group">
					{!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'Buscar x telefono o celular','aria-describedby'=>'search']) !!}
					<span class="input-group-addon" id="search">
						<span class="glyphicon glyphicon-search" hidden="true"></span>
					</span>
				</div>
			{!! Form::close() !!}
			<!--FIN DEL BUSCADOR-->
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Nombres y Apellidos</th>
						<th>Teléfono</th>
						<th>Celular</th>
						<th>Email</th>
						<th>Disponibilidad</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($ownerscurrents as $ownercurrent)
							<tr>
								<td>{{ $ownercurrent->id }}</td>
								<td>{{ $ownercurrent->first_name.' '.$ownercurrent->last_name }}</td>
								<td>{{ $ownercurrent->phone }}</td>
								<td>{{ $ownercurrent->cell_phone }}</td>
								<td>{{ $ownercurrent->email }}</td>
								<td>{{ $ownercurrent->availability }}</td>
								<td>
									<a href="{{ route('admin.ownerscurrents.edit', $ownercurrent->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="{{ route('admin.ownerscurrents.destroy', $ownercurrent->id) }}" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $ownerscurrents->render() !!}
			</div>
		</div>		
</div>
@endsection