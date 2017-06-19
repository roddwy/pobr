@extends('admin.template.main')

@section('title','Lista de las Categorias')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE TODAS LAS CATEGORIAS</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.categories.create') }}" class="btn btn-info">Registrar Nueva Categoria</a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Categoria</th>
						<th>Acción</th>
					</thead>
					<tbody>
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->id}}</td>
								<td>{{ $category->name }}</td>
								<td>
									<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
									<a href="{{ route('admin.categories.destroy',$category->id) }}" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $categories->render() !!}
			</div>
		</div>		
</div>
@endsection