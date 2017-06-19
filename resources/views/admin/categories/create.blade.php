@extends('admin.template.main')

@section('title', 'Creación de categoria')

@section('content')
	{!! Form::open(['route'=>'admin.categories.store','method'=>'POST']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">CREACIÓN DE UNA NUEVA CATEGORIA</div>
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
					{!! Form::label('name','Nombre de la categoria',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre de la nueva categoria']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Registrar Categoria', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection