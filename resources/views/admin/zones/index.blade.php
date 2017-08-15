@extends('admin.template.main')

@section('title','Lista de las zonas')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODAS LAS ZONAS</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.zones.create') }}" class="btn btn-info">Registrar Nueva Zona</a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Nombre de la Zona</th>
						<th>Usuario Designado</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($zones as $zone)
							<tr>
								<td>{{ $zone->id}}</td>
								<td>{{ $zone->name }}</td>
								<td>
									@if($zone->user->type_user->name == 'Administrador')
										<span class="btn btn-danger">Zona sin ser Designado</span>
									@else
									{{$zone->user->first_name.' '.$zone->user->last_name}}
									@endif
								</td>
								<td>
									<a href="{{ route('admin.zones.edit', $zone->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="{{ route('admin.zones.destroy', $zone->id) }}" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $zones->render() !!}
			</div>
		</div>		
</div>
@endsection