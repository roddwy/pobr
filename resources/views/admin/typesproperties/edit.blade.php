@extends('admin.template.main')

@section('title','Editar Tipo de Propiedad')

@section('content')
	{!! Form::open(['route'=>['admin.typesproperties.update', $typeproperty],'method'=>'PUT']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">EDICIÓN DE TIPO DE PROPIEDAD {{ $typeproperty->name }}</div>
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
					{!! Form::label('name','Nombre del tipo de Propiedad',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('name',$typeproperty->name,['class'=>'form-control','placeholder'=>'Nombre del tipo de propiedad','required']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Cambiar datos del tipo de propiedad', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection