@extends('admin.template.main')

@section('title','Reportes General')

@section('content')
<script type="text/javascript">
	function enviar(destino){
		document.formulario.action = destino;
		document.formulario.submit();
	}
</script>
<style type="text/css">
	#graphPie{
		width: 100%;
		background-color: #fff;
		height: 500px;
	}
</style>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
				<div class="panel-heading">REPORTES INMUEBLES EXCEL</div>
				<div class="panel-body">
					
								
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
								{!! Form::model(Request::all(),['method'=>'GET', 'class'=>'navbar-form', 'name'=>'formulario']) !!}
									<!--<div class="form-group">
										{!! Form::label('Fecha', 'Seleccione Fecha') !!}
										
											<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
								
										
										<button type="submit" class="btn btn-default">Exportar el total</button>
									</div>-->
									<div class="text-center">
										{!! Form::label('Fecha', 'Seleccione Fecha') !!}
										<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
									</div>
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<!--REPORTE GENERAL-->
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"excel" id="excel" onClick="enviar('{{route('admin.reportegeneral')}}')">Exportar General Excel</button>
									</div>	
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"pdf" id="pdf" onClick="enviar('{{route('admin.reportegeneralpdf')}}')">Exportar General Pdf</button>
									</div>
								</div>
									<!--REPORTES VENDIDOS-->
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"excel" id="excel" onClick="enviar('{{route('admin.reportevendido')}}')">Exportar Vendidos Excel</button>
									</div>

									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"pdf" id="pdf" onClick="enviar('{{route('admin.reportevendidospdf')}}')">Exportar Vendidos Pdf</button>
									</div>
								</div>
									<!--REPORTES ACTIVOS-->
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"excel" id="excel" onClick="enviar('{{route('admin.reporteactivo')}}')">Exportar Activos Excel</button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"pdf" id="pdf" onClick="enviar('{{route('admin.reporteactivopdf')}}')">Exportar Activos Pdf</button>
									</div>
								</div>
									<!--REPORTES INACTIVOS-->
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"excel" id="excel" onClick="enviar('{{route('admin.reporteinactivo')}}')">Exportar Inactivos Excel</button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"pdf" id="pdf" onClick="enviar('{{route('admin.reporteinactivopdf')}}')">Exportar Inactivos Pdf</button>
									</div>
								</div>
									<!--REPORTES OFERTAS-->
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"excel" id="excel" onClick="enviar('{{route('admin.reporteoferta')}}')">Exportar Ofertas Excel</button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" name"pdf" id="pdf" onClick="enviar('{{route('admin.reporteofertapdf')}}')">Exportar Ofertas Pdf</button>
									</div>
								</div>
								{!! Form::close() !!}
								<!--{!! Form::model(Request::all(),['route'=>'admin.reportevendido', 'method'=>'GET', 'class'=>'navbar-form']) !!}
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
								{!! Form::close() !!}-->
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
							<div class="text-center">
								{!! Form::label('Fecha', 'Seleccione Fecha') !!}							
								<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >
							</div>
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-default">Exportar vendidos de cada usuario</button>
							</div>
						</div>
						</div>	
				{!! Form::close() !!}
				<div class="text-center">
					<h3>TOTAL INMUEBLES CADAUSUARIO</h3>
				</div>
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					    <a href="{{ route('admin.reporteusuariototal') }}"><button type="button" class="btn btn-default">Exportar total de Inmuebles de Usuarios</button></a>
					</div>	
				</div>				
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">REPORTES CLIENTES EXCEL</div>
			<div class="panel-body">

				{!! Form::model(Request::all(),['route'=>'admin.reporteclientes', 'method'=>'GET', 'class'=>'navbar-form']) !!}
					<div class="form-group">
						{!! Form::label('Fecha', 'Seleccione Fecha') !!}					
						<input type="month" name="date" step="1" min="2016-12" max="2020-12" value="2017-01" class="form-control" >						
						<button type="submit" class="btn btn-default">Exportar clientes interesados</button>
					</div>	
				{!! Form::close() !!}						
				</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">GRÁFICA</div>
			<div class="panel-body">
					<div id="graphPie"></div>
				    {!! $graphPie->render('PieChart', 'IMDB', 'graphPie') !!}
		    </div>
		    <div class="btn-group btn-group-justified" role="group" aria-label="...">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" name"excel" id="excel">Gráfico</button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" name"pdf" id="pdf">Gráfico Pdf</button>
				</div>
			</div>
		</div>
		
	</div>
</div>

@endsection