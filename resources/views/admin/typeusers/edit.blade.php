@extends('admin.template.main')

@section('title','Editar Tipo Usuario')

@section('content')
	{!! Form::open(['route'=>['admin.typeusers.update', $typeuser],'method'=>'PUT']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">EDICIÓN DE TIPO USUARIO {{ $typeuser->name }}</div>
		<div class="panel-body">
			<div class="form-horizontal">				
				<div class="form-group">
					{!! Form::label('name','Nombre de tipo de Usuario',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('name',$typeuser->name,['class'=>'form-control','placeholder'=>'Nombre de Tipo de Usuario']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Cambiar datos Tipo Usuario', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection