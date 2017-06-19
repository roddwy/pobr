@extends('admin.template.main')

@section('title','Lista de tipos de propiedades')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODOS LOS TIPOS DE PROPIEDADES</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.typesproperties.create') }}" class="btn btn-info">Registrar Nuevo Tipo de Propiedad</a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Tipo de Propiedad</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($typesproperties as $typeproperty)
							<tr>
								<td>{{ $typeproperty->id}}</td>
								<td>{{ $typeproperty->name }}</td>
								<td>
									<a href="{{ route('admin.typesproperties.edit', $typeproperty->id )}}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="{{ route('admin.typesproperties.destroy', $typeproperty->id ) }}" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $typesproperties->render() !!}
			</div>
		</div>		
</div>
@endsection