@extends('admin.template.main')

@section('title','Sms')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">LISTA DE CLIENTES INTERESADOS</div>
		<div class="panel-body">
			@include('flash::message')
			<a href="{{ route('admin.states.create') }}" class="btn btn-info">Enviar Sms a todos</a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>Id</th>
						<th>Nombres</th>
						<th>Telefono</th>
						<th>Celular</th>
						<th>Email</th>
					</thead>
					<tbody>
						@foreach($customers as $customer)
							<tr>
								<td>{{ $customer->id}}</td>
								<td>{{ $customer->first_name.' '.$customer->last_name }}</td>
								<td>{{ $customer->phone }}</td>
								<td>{{ $customer->cell_phone }}</td>
								<td>{{ $customer->email }}</td>
								<td>
									<a href="{{ route('admin.sms.send', $customer->id) }}" class="btn btn-info">Enviar Sms</a>
									<a href="#" onclick="return confirm('¿Seguro que deseas Eliminarlo?')" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $customers->render() !!}
			</div>
		</div>		
</div>
@endsection