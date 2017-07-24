@extends('admin.template.main')

@section('title','Reportes General')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading">REPORTES GENERAL INMUEBLES EXCEL</div>
		<div class="panel-body">
			
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				{!! Form::model(Request::all(),['route'=>'admin.reportegeneral', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar el total</button>
					</div>	
				{!! Form::close() !!}
				{!! Form::model(Request::all(),['route'=>'admin.reportevendido', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar Vendidos</button>
					</div>	
				{!! Form::close() !!}
				{!! Form::model(Request::all(),['route'=>'admin.reporteactivo', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar Activos</button>
					</div>	
				{!! Form::close() !!}
				{!! Form::model(Request::all(),['route'=>'admin.reporteinactivo', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar Dados Baja</button>
					</div>	
				{!! Form::close() !!}
				{!! Form::model(Request::all(),['route'=>'admin.reporteoferta', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar Ofertas</button>
					</div>	
				{!! Form::close() !!}
			</div>
			<!--<div class="btn-group btn-group-justified" role="group" aria-label="...">
			  <div class="btn-group" role="group">
			    <a href="{{ route('admin.reportegeneral') }}"><button type="button" class="btn btn-default">Exportar Todos</button></a>
			  </div>
			  <div class="btn-group" role="group">
			    <a href="{{ route('admin.reportevendido') }}"><button type="button" class="btn btn-default">Exportar Vendidos</button></a>
			  </div>
			  <div class="btn-group" role="group">
			    <a href="{{ route('admin.reporteactivo') }}"><button type="button" class="btn btn-default">Exportar Activos</button></a>
			  </div>
			  <div class="btn-group" role="group">
			    <a href="{{ route('admin.reporteoferta') }}"><button type="button" class="btn btn-default">Exportar Ofertas</button></a>
			  </div>
			  <div class="btn-group" role="group">
			    <a href="{{ route('admin.reporteinactivo') }}"><button type="button" class="btn btn-default">Exportar Inactivos</button></a>
			  </div>
			</div>-->					
		</div>
</div>

<div class="panel panel-default">
		<div class="panel-heading">REPORTES POR USUARIOS EXCEL</div>
		<div class="panel-body">

			{!! Form::model(Request::all(),['route'=>'admin.reporteusuariovendido', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}
						
							<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
				
						
						<button type="submit" class="btn btn-default">Exportar vendidos de cada usuario</button>
					</div>	
			{!! Form::close() !!}
			<div class="btn-group" role="group">
			    <a href="{{ route('admin.reporteusuariototal') }}"><button type="button" class="btn btn-default">Exportar total de Inmuebles de Usuarios</button></a>
			  </div>					
		</div>
</div>
@endsection