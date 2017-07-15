@extends('admin.template.main')

@section('title', 'Creación Inmueble')

@section('content')
	{!! Form::open(['route'=>'admin.properties.store','method'=>'POST','files'=>true]) !!}
	<div class="panel panel-default">
		<div class="panel-heading">CREACIÓN DE NUEVO INMUEBLE para el dueño {{ $ownercurrent->first_name}}</div>
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
					{!! Form::label('admission_date','Fecha  de Registro :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::date('admission_date',null,['class'=>'form-control','placeholder'=>'Introduzca la fecha']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('sale_price','Precio de Venta :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('sale_price',null,['class'=>'form-control','placeholder'=>'Introduzca el precio de venta']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('offer_price','Precio de Oferta :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('offer_price',null,['class'=>'form-control','placeholder'=>'Introduzca el precio de oferta']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('comission','Comisión :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('comission',null,['class'=>'form-control','placeholder'=>'Introduzca la comisión']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('financing','Financiamiento :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('financing',null,['class'=>'form-control','placeholder'=>'Introduzca financiamiento']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('building','Edificio :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('building',null,['class'=>'form-control','placeholder'=>'Introduzca edificio']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('piso','Piso :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('piso',null,['class'=>'form-control','placeholder'=>'Introduzca piso']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('no_dpto','Numero Departamento :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('no_dpto',null,['class'=>'form-control','placeholder'=>'Introduzca el numero de departamento']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('referencies','Referencias :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('referencies',null,['class'=>'form-control','placeholder'=>'Introduzca referencias']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('antiquily','Antiguedad :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('antiquily',null,['class'=>'form-control','placeholder'=>'Introduzca Antiguedad']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('legal_document','Documento Legal :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('legal_document',null,['class'=>'form-control','placeholder'=>'Introduzca Documento Legal']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('avaluo','Avaluo :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('avaluo',null,['class'=>'form-control','placeholder'=>'Introduzca Avaluo']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('delivery_time','Tiempo de Entrega :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('delivery_time',null,['class'=>'form-control','placeholder'=>'Introduzca Tiempo de entrega']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('additional_inf','Información Adicional :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('additional_inf',null,['class'=>'form-control','placeholder'=>'Introduzca Información adicional']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('bedrooms','Cuartos :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('bedrooms',null,['class'=>'form-control','placeholder'=>'Introduzca Cuartos']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('kitchens','Cocinas :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('kitchens',null,['class'=>'form-control','placeholder'=>'Introduzca Cocinas']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('bathrooms','Baños :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('bathrooms',null,['class'=>'form-control','placeholder'=>'Introduzca Baños']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('livingrooms','Salas :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('livingrooms',null,['class'=>'form-control','placeholder'=>'Introduzca Salas']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('garages','Garajes :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('garages',null,['class'=>'form-control','placeholder'=>'Introduzca Garajes']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('asensors','Asensores :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('asensors',null,['class'=>'form-control','placeholder'=>'Introduzca Asensores']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('suite','Suite :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('suite',null,['class'=>'form-control','placeholder'=>'Introduzca Suite']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('pantry','Despensa :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('pantry',null,['class'=>'form-control','placeholder'=>'Introduzca Despensa']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('deskrooms','Escritorio :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('deskrooms',null,['class'=>'form-control','placeholder'=>'Introduzca Escritorio']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('servicesrooms','Cuartos de Servicio :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('servicesrooms',null,['class'=>'form-control','placeholder'=>'Introduzca Cuartos de Servicio']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('storages','Almacen :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('storages',null,['class'=>'form-control','placeholder'=>'Introduzca Almacen']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('others','Otros :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('others',null,['class'=>'form-control','placeholder'=>'Introduzca Otros']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('surface_area','Superficie de Área :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('surface_area',null,['class'=>'form-control','placeholder'=>'Introduzca Superficie de area']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('surface_builder','Superficie Contruida :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('surface_builder',null,['class'=>'form-control','placeholder'=>'Introduzca Superficie Contruida']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>GOOGLE MAPS</h3>
					</div>
				</div>
				<!--MAPA-->
				<div class="col-md-12">
				<style>
					#map{
						outline: 2px solid grey;						
						width: 100%;
						height: 450px;
					}
					#coords{
						width: 500px;
					}
				</style>
				<div id="map"></div>
				<hr>
					<div class="form-group">
						{!! Form::label('lat_map','Latitud :',['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::number('lat_map',null,['id'=>'coordslat','class'=>'form-control','placeholder'=>'Introduzca latitud del mapa','step'=>'any']) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('lng_map','Longitud :',['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::number('lng_map',null,['id'=>'coordslng','class'=>'form-control','placeholder'=>'Introduzca longitud del mapa','step'=>'any']) !!}
						</div>
					</div>
					<script>
					var marker;
					var coords = {};
					//Funcion principal
					initMap = function () 
					{
						//usamos la API para geolocalizar el usuario
						navigator.geolocation.getCurrentPosition(
							function (position){
								coords = {
									lng: position.coords.longitude,
									lat: position.coords.latitude
								};
							setMapa(coords);//pasamos las coordenadas al metodo para crear mapa

							}, function(error){console.log(error);});
					}

					function setMapa (coordslat, coordslng)
					{
						//se crea una nueva instancia del objeto mapa
						var map = new google.maps.Map(document.getElementById('map'),
						{
							zoom: 13,
							center: new google.maps.LatLng(coords.lat,coords.lng),
						}); 
						//Creamos el marcador en el mapa con sus propiedades
						//para nuestro objetivo tenemos que poner el atributo draggable en true
						//position pondremos las mismas Coordenadas que obtuvimos en la geolocalizacion
						marker = new google.maps.Marker({
							map: map,
							draggable: true,
							animation: google.maps.Animation.DROP,
							position: new google.maps.LatLng(coords.lat,coords.lng),
						});
						//agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
						//cuando el usuario a soltado el marcador
						marker.addListener('click', toggleBounce);
						marker.addListener('dragend', function(event)
						{
							//escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
							document.getElementById("coordslat").value = this.getPosition().lat();
							document.getElementById("coordslng").value = this.getPosition().lng();
						});
					}

					//callback al hacer click en el marcador lo que hace es quitar y poner la animacion BOUNCE
					function toggleBounce(){
						if (marker.getAnimation() !== null) {
							marker.setAnimation(null);
						}else{
							marker.setAnimation(google.maps.Animation.BOUNCE);
						}
					}
					//Carga de la libreria de google maps
					</script>
					<script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ8D5zq8vK9PnanQ36WW9-DpwI8vmtyB0&callback=initMap">
                    </script>
				</div>
				<!--END MAPA-->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>DIRECCIÓN</h3>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('street','Calle :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::text('street',null,['class'=>'form-control','placeholder'=>'Introduzca Calle']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('zone_id','Zona :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('zone_id', $zones, null, ['class'=>'form-control', 'placeholder'=>'introduzca zona', 'required']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>CATEGORIA</h3>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('category_id','Categoria :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'placeholder'=>'introduzca una categoria', 'required']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>TIPO</h3>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('type_property_id','Tipo de Propiedad :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('type_property_id', $typesproperties, null, ['class'=>'form-control', 'placeholder'=>'introduzca un tipo de propiedad', 'required']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>ESTADO</h3>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('state_id','Estado de Inmueble :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('state_id', $states, null, ['class'=>'form-control', 'placeholder'=>'introduzca un estado de inmueble', 'required']) !!}
					</div>
				</div>
				<div class="form-group">
					
					{!! Form::text('owner_current_id', $ownercurrent->id, ['class'=>'form-control', 'placeholder'=>'id de propietario', 'required', 'style'=>'display:none']) !!}
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<h3>IMÁGENES</h3>
					</div>
				</div>				
				<div class="form-group">
					{!! Form::label('image','Imagenes :',['class'=>'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::file('image[]',['multiple']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{!! Form::submit('Registrar Inmueble', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>
		</div>		
	</div>
	{!! Form::close() !!}
@endsection