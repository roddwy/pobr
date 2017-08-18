@extends('admin.template.main')

@section('title','Lista de Propietarios')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODOS LOS INMUEBLES</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="#" class="btn btn-info"></a>
			<!--BUSCADOR DE INMUEBLES-->
			@if(Auth::user()->type_user->name == 'Administrador')
			{!! Form::open(['route'=>'admin.properties.index', 'method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
				
				{!! Form::select('state_id', $states, null,['class'=>'form-control','placeholder'=>'Buscar por Estado']) !!}
					
				
				<button type="submit" class="btn btn-default">Busqueda Estado</button>
			{!! Form::close() !!}
			@endif
			<!--FIN DEL BUSCADOR-->
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Fecha de Registro</th>
						<th>Precio de Venta</th>
						<th>Precio de Oferta</th>
						<th>Cant. Imagenes</th>
						<th>Estado</th>
						<th>Propietario</th>
						<th>Tel/Celular Propietario</th>
						<th>Asesor Encargado</th>
						@if(\Auth::user()->type_user->name == 'Administrador')
							<th>Acción</th>
						@endif
					</thead>
					<tbody>
						@foreach($properties as $property)
							<tr>
								<td>{{ $property->id }}</td>
								<td>{{ $property->admission_date }}</td>
								<td>{{ $property->sale_price }}</td>
								<td>{{ $property->offer_price }}</td>								
								<td>{{ count($property->images) }}</td>
								<td>{{ $property->state->name }}</td>
								<td>{{ $property->owner_current->first_name.' '.$property->owner_current->last_name}}</td>
								<td>{{ $property->owner_current->phone.' / '.$property->owner_current->cell_phone }}</td>
								<td>{{ $property->user->first_name.' '.$property->user->last_name}}</td>
								<td>
									@if(\Auth::user()->type_user->name == 'Administrador')
										<a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
										<a href="#" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
									@endif								
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $properties->render() !!}
			</div>
		</div>		
</div>
@endsection