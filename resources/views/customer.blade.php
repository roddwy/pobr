@extends('templatefront.main')

@section('title','Clientes')

@section('content')

<hr>
<div class="row rowtitulo">
	<div class="col-md-12">
		<h1 class="text-center">Registro de Cliente</h1>
	</div>	
</div>
@include('flash::message')
	{!! Form::open(['route'=>'customercreate','method'=>'POST']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">Contacto</div>
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
				<div class="form-group frmcustomercontac">
					{!! Form::label('first_name','Nombres :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Nombres']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
					{!! Form::label('last_name','Apellidos :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Apellidos']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
					{!! Form::label('phone','Teléfono :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'No. Teléfono']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
					{!! Form::label('cell_phone','Celular :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('cell_phone11',null,['class'=>'form-control','placeholder'=>'No. de Celular']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
		          				<input type="text" style="display:none" name="property" id="property" value="1">
		         </div>	
				<div class="form-group frmcustomercontac">
					{!! Form::label('email', 'Email :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::email('email', null, ['class' => 'form-control','placeholder' =>'ejemplo@gmail.com']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
					{!! Form::label('description','Sugerencias :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('suge',null,['class'=>'form-control','placeholder'=>'Escríbanos su sugerencia','required']) !!}
					</div>
				</div>
				<br>
				<div class="form-group frmcustomercontac">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Registrarse', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection