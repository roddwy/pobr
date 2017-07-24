@extends('templatefront.main')

@section('title','Home')

@section('mapa')
<style type="text/css">
    #mapa { height: 500px; }
    .imgmapa{
      height: 100px;
      width: 100px;

    }
    
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    function initialize() {
      var marcadores = <?php echo json_encode($coordenadas, JSON_PRETTY_PRINT) ?>;
      
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 12,
        center: new google.maps.LatLng(-16.5207007, -68.1615535),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i].lat, marcadores[i].lng),
          map: map,
          title: marcadores[i].tipo
        });
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            var route = "{{route('detailproperty','') }}"+'/'+marcadores[i].idproperty; 
            var image = '<p>'+marcadores[i].tipo+'</p><a href='+route+'><img src="images/properties/'+marcadores[i].image+'" class="imgmapa"></a>'
            infowindow.setContent(image);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ8D5zq8vK9PnanQ36WW9-DpwI8vmtyB0&callback=initMap">
                    </script>   
@endsection
@section('content')  

<hr>
<div class="row rowtitulo">
    <div class="col-md-12">
        <h1 class="text-center">Bienvenido a Bienes Raices Orion</h1>
    </div>  
</div>


<!-- CARGA DE LOS INMUEBLES -->
<div class="row">
   @foreach($properties as $property)
        <!--@if(($property->state->name) != 'Inactivo' && ($property->state->name) !='Vendido')-->
            <div class="col-md-3">
                <div class="thumbnail">                     
                        <h3 class="text-center">{{$property->type_property->name}} en {{ $property->category->name }}</h3>
                            <h3 class="text-center">{{ $property->state->name }}</h3>
                            <!--{{ count($property->images) }}-->

                            @if(count($property->images)!=0)
                            <a href="{{ route('detailproperty', $property->id ) }}">
                                <img src="images/properties/{{$property->images->first()->name}}" class="img-responsive img-principal">
                            @else
                                <img src="images/properties/orion_1491116798.Page 10.png" class="img-responsive img-principal"alt="Descripción de esta maravillosa imagen">
                            @endif  
                            </a>                
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

<div id="mapa"></div>
<!-- PAGINACION-->
    <div class="text-center">
        {!! $properties->render() !!}
    </div>
<!-- FIN DE PAGINACION-->
@endsection