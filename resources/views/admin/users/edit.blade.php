@extends('admin.template.main')

@section('title','Editar Usuario')

@section('content')
	{!! Form::open(['route'=>['admin.users.update', $user],'method'=>'PUT']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">EDICIÓN DEL USUARIO {{ $user->first_name.' '.$user->last_name }}</div>
		<div class="panel-body">
			<div class="form-horizontal">				
				<div class="form-group">
					{!! Form::label('first_name','Nombres :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('first_name',$user->first_name,['class'=>'form-control','placeholder'=>'Nombres','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('last_name','Apellidos :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('last_name',$user->last_name,['class'=>'form-control','placeholder'=>'Apellidos','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('ci','Ci :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('ci',$user->ci,['class'=>'form-control','placeholder'=>'No Cédula de Identidad','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone','Teléfono :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('phone',$user->phone,['class'=>'form-control','placeholder'=>'No. Teléfono','title'=>'Debe contener 7 digitos y empezar de 2,3 o 4. Ejemplo 2396919','pattern'=>'^[2|3|4][0-9]{6}','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('cell_phone','Celular :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('cell_phone',$user->cell_phone,['class'=>'form-control','placeholder'=>'No. de Celular','title'=>'Debe contener 8 digitos y empezar de 6 o 7. Ejemplo 70192586','pattern'=>'^[6|7][0-9]{7}','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::email('email', $user->email, ['class' => 'form-control','placeholder' =>'ejemplo@gmail.com','required']) !!}
					</div>
				</div>
				
				<div class="form-group">
					{!! Form::label('type_user', 'Tipo de Usuario :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('type_user_id', $typeusers, $user->type_user_id, ['class'=>'form-control','required']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Cambiar datos del Usuario', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection