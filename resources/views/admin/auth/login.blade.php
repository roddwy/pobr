@extends('admin.template.main')

@section('title', 'Login')

@section('content')

	{!! Form::open(['route'	=>	'admin.auth.login', 'method' => 'POST'])!!}
	<div class="panel panel-default login">
		<div class="panel-heading">LOGIN</div>
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
				 	{!! Form::label('email', 'Email',['class'=>'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 		{!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Introduzca Email']) !!}
				 	</div>
				 </div>
				 <div class="form-group">
				 	{!! Form::label('password', 'Contraseña',['class'=>'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 		{!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'******************']) !!}
				 	</div>
				 </div>
				 <div class="form-group">
				 	<div class="col-sm-offset-2 col-sm-10">
				 		{!! Form::submit('Acceder al Sistema', ['class'=>'btn btn-primary']) !!}
				 	</div>
				 </div>
			</div>
		 </div>
	</div>
	{!! Form::close() !!}


@endsection