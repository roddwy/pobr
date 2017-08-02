@extends('templatefront.main')

@section('title','Ofertas')

@section('content') 

<hr>
<div class="row rowtitulo">
	<div class="col-md-12">
		<h1 class="text-center">Bienvenido Ofertas</h1>
	</div>	
</div>

<!-- CARGA DE LOS INMUEBLES -->
<div class="row">
  	@foreach($properties as $property)
  		
	  		<!--@if(($property->state->name) == 'Oferta')-->
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
                                
                                <p class="ofertainmueble">OFERTA</p> 
                                                             
                                <p class="infoinmueble">{{$property->type_property->name.' en '.$property->category->name.' a $'.$property->sale_price}}</p><p class="text-center">{{ $property->zone->name }}, {{ $property->street}}</p>
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
			{!! $properties->render() !!}
	</div>
<!-- FIN DE PAGINACION-->
@endsection