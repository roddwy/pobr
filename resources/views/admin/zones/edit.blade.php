@extends('admin.template.main')

@section('title','Editar Zona')

@section('content')
	{!! Form::open(['route'=>['admin.zones.update', $zone],'method'=>'PUT']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">EDICIÓN DE LA ZONA {{ $zone->name }}</div>
		<div class="panel-body">
			@if(count($errors) > 0)
				<div class="alert alert-danger" role="alert">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>			
				</div>
			@endif
			<div class="form-horizontal">				
				<div class="form-group">
					{!! Form::label('name','Nombre de la nueva zona :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('name',$zone->name,['class'=>'form-control','placeholder'=>'Nombre de la Zona']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Cambiar datos de la Zona', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection