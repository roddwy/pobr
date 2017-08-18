@extends('admin.template.main')

@section('title', 'Creación Propietario')

@section('content')
	{!! Form::open(['route'=>'admin.ownerscurrents.store','method'=>'POST']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">CREACIÓN DE NUEVO PROPIETARIO</div>
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
					{!! Form::label('first_name','Nombres :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Nombres']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('last_name','Apellidos :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Apellidos']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone','Teléfono :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'No. Teléfono','title'=>'Debe contener 7 digitos y empezar de 2,3 o 4. Ejemplo 2396919','pattern'=>'^[2|3|4][0-9]{6}','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('cell_phone','Celular :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('cell_phone',null,['class'=>'form-control','placeholder'=>'No. de Celular','title'=>'Debe contener 8 digitos y empezar de 6 o 7. Ejemplo 70192586','pattern'=>'^[6|7][0-9]{7}','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::email('email', null, ['class' => 'form-control','placeholder' =>'ejemplo@gmail.com']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('availability', 'Disponibilidad :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('availability', null, ['class' => 'form-control','placeholder' =>'Disponibilidad']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Registrar Propietario', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection