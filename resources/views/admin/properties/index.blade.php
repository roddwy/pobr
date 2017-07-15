@extends('admin.template.main')

@section('title','Lista de Propietarios')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODOS LOS INMUEBLES</div>
		<div class="panel-body">
			@include('flash::message')
			<!--BUSCADOR DE PROPIETARIOS-->
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Fecha de Registro</th>
						<th>Precio de Venta</th>
						<th>Precio de Oferta</th>
						<th>Cant. Imagenes</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($properties as $property)
							<tr>
								<td>{{ $property->id }}</td>
								<td>{{ $property->admission_date }}</td>
								<td>{{ $property->sale_price }}</td>
								<td>{{ $property->offer_price }}</td>
								<td>{{ count($property->images) }}</td>
								<td>
									<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="#" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
									<a href="#" onclick="return confirm('¿Seguro que desea Agregar un Inmueble al usuario?')"class="btn btn-info">Agregar <span class="glyphicon glyphicon-home"></span></a>
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