@extends('templatefront.main')

@section('title','Busquedas')

@section('content') 
<div class="row rowtitulo">
	<div class="col-md-12">
		<h1 class="text-center tituloprincipal">BUSQUEDA PERSONALIZADA</h1>
		{!! Form::model(Request::all(),['route'=>'search', 'method'=>'GET', 'class'=>'navbar-form']) !!}
			<div class="form-group">
				<!--{!! Form::label('tipo', 'Tipo') !!}-->
				{!! Form::select('type_property_id',$types ,null, ['class'=>'form-control busqueda','placeholder'=>'Buscar x tipo']) !!}
				<!--{!! Form::label('tipo', 'Categoria') !!}-->
				{!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'placeholder'=>'Buscar x categoria']) !!}
				<!--{!! Form::label('tipo', 'Zona') !!}-->
				{!! Form::select('zone_id', $zones, null, ['class'=>'form-control', 'placeholder'=>'Zona']) !!}
				{!! Form::label('tipo', 'Precio Min') !!}
				{!! Form::select('sale_price', ['100'=>'100','1000'=>'1000'],null, ['class'=>'form-control','placeholder'=>'precio']) !!}

				{!! Form::label('tipo', 'Precio Max') !!}
				{!! Form::select('sale_price2',['10000'=>'10000','50000'=>'50000','100000'=>'100000'],null, ['class'=>'form-control','placeholder'=>'precio']) !!}
				
				<!--{!! Form::label('tipo', 'Presione el boton') !!}-->
				<button type="submit" class="btn btn-default">Busqueda Especial</button>
			</div>	
		{!! Form::close() !!}
	</div>
</div>

<!-- CARGA DE LOS INMUEBLES -->
<div class="row">
   @foreach($properties as $property)
   		<!--@if(($property->state->name)!='Inactivo' && ($property->state->name)!='Vendido')-->
	  		<div class="col-md-3">
                    <div class="thumbnail">
                                                         
                                <!--<h3 class="text-center">{{ $property->state->name }}</h3>-->
                                <!--{{ count($property->images) }}-->

                                @if(count($property->images)!=0)
                                <a href="{{ route('detailproperty', $property->id ) }}">
                                    <img src="images/properties/{{$property->images->first()->name}}" class="img-responsive img-principal" alt="img-principal" style="width:100%">
                                @else
                                    <img src="images/properties/orion_1491116798.Page 10.png" class="img-responsive img-principal"alt="Descripción de esta maravillosa imagen">
                                @endif  
                                </a> 
                                @if($property->state->name == 'Oferta')
                                <p class="ofertainmueble">OFERTA</p> 
                                @endif                             
                                <p class="infoinmueble">{{$property->type_property->name.' en '.$property->category->name.' a $'.number_format($property->sale_price)}}</p><p class="text-center">{{ $property->zone->name }}, {{ $property->street}}</p>
                                <a href="{{ route('detailproperty', $property->id ) }}" class="btn btn-primary btnmasinformacion" role="button">Mas información</a>
                                      
                    </div>
                </div>
	  	<!--@endif-->			
	@endforeach 
</div>  
<!-- FIN DE CARGA DE LOS INMUEBLES -->
<hr>

<!-- PAGINACION-->
	<div class="text-center">
		{!! $properties->appends(Request::only(['type_property_id', 'category_id', 'zone_id', 'sale_price','sale_price2','state_id']))->render() !!}
	</div>
<!-- FIN DE PAGINACION-->
@endsection