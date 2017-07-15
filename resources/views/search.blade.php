@extends('templatefront.main')

@section('title','Busquedas')

@section('content') 
<div class="row rowtitulo">
	<div class="col-md-12">
		<h1 class="text-center">BUSQUEDA PERSONALIZADA</h1>
		{!! Form::model(Request::all(),['route'=>'search', 'method'=>'GET', 'class'=>'navbar-form']) !!}
			<div class="form-group">
				{!! Form::label('tipo', 'Tipo') !!}
				{!! Form::select('type_property_id',$types ,null, ['class'=>'form-control','placeholder'=>'Buscar x tipo']) !!}
				{!! Form::label('tipo', 'Categoria') !!}
				{!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'placeholder'=>'Buscar x categoria']) !!}
				{!! Form::label('tipo', 'Zona') !!}
				{!! Form::select('zone_id', $zones, null, ['class'=>'form-control', 'placeholder'=>'Zona']) !!}
				{!! Form::label('tipo', 'Precio') !!}
				{!! Form::text('sale_price', null, ['class'=>'form-control', 'placeholder'=>'Buscar x precio']) !!}
				
				{!! Form::label('tipo', 'Presione el boton') !!}
				<button type="submit" class="btn btn-default">Busqueda Especial</button>
			</div>	
		{!! Form::close() !!}
	</div>
</div>




<!-- CARGA DE LOS INMUEBLES -->
<div class="row">
   @foreach($properties as $property)
   		<!--@if(($property->state->name)!='Inactivo' && ($property->state->name)!='Vendido')-->
	  		<div class="col-md-4">
	    		<div class="thumbnail"> 
	    			<h3>{{$property->type_property->name}} en {{ $property->category->name }} precio {{ $property->sale_price }}</h3>
	    			<h2>{{ $property->state->name }}</h2>
	    			<h3>Superficie{{$property->surface_area}}</h3>
	    				<!--{{ count($property->images) }}-->
	    				@if(count($property->images)!=0)
							<img src="images/properties/{{$property->images->first()->name}}" class="img-responsive img-principal">
						@else
							<img src="images/properties/orion_1491116798.Page 10.png" class="img-responsive img-principal"alt="Descripción de esta maravillosa imagen">
						@endif	    			
	      			<div class="caption">
	      				
		        		<p>En {{ $property->zone->name }} calle {{ $property->street}}</p>
		        		<p><a href="{{ route('detailproperty', $property->id ) }}" class="btn btn-danger btn-lg btn-block" role="button">Mas información</a></p>
	      			</div>
	    		</div>
	  		</div>
	  	<!--@endif-->			
	@endforeach 
</div>  
<!-- FIN DE CARGA DE LOS INMUEBLES -->
<hr>

<!-- PAGINACION-->
	<div class="text-center">
		{!! $properties->appends(Request::only(['type_property_id', 'category_id', 'zone_id', 'sale_price','state_id']))->render() !!}
	</div>
<!-- FIN DE PAGINACION-->
@endsection