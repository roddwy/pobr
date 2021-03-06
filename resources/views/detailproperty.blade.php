<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{!! csrf_token() !!}" />
	<title>@yield('title', 'Detalles') | ORION BIENES RAICES</title>
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">	
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<!--SCRIPT PRUEBAS-->
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="{{asset('plugins/css/font-awesome.min.css')}}">
	<!--FIN DE SCRIPT PRUEBAS-->
	<style>
		body{
    		background-color: #BECEBB;
		}
		h1{
			color:#fff;
			margin-top:10px;
			margin-bottom: 10px;
			font-family: 'Anton', sans-serif;			
		}
		p{
			margin-top: 10px;
			text-align: justify;
		}
		.itemsproperty{
			text-align: justify;
		}
		.linavbar{
			font-family: 'Fjalla One', sans-serif;
			font-size: 20px;
		}
		.titulonavbar{
			font-family: Elephant;
			color: #BECEBB;
			font-size: 30px;

		}
		.navbar{
			margin-bottom: 5px;
			/*background-color: #BB1F35;*/
			background: -webkit-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* Standard syntax */
			  background: linear-gradient(to right,#0981C0,indigo,#B00C7C); 

		}
		.navbar-form{
			background: #BB1F35;
			padding: 15px;
		}
		.row{
			margin:2%;
			background-color: #fff;
		}

		.row-detalle{
			margin:0%;
		}
		
		li.detalle{
			font-size: 10px;
		}
		
		.panel{			
			margin-right: 2%;
			margin-left: 2%;
			
			margin-bottom: 5px;
		}

		.img{
		    height: 80px;
		    width: 78px;
		    border: 3px solid grey;
		}
		.fondo{
			background: #000;
		}
		#contenedor{
			background-color: #000;
			text-align: center;
		}
		h1{
			color:red;
			font-size: 30px;
		}
		h3{
			margin:0px;
		}

		#galeria{
		    
		    background-color: grey;
		    width: 100%;
		    height: 100%;
		}
		/*AQUI DEL VISOR DE IMAGENES*/
		#principal{
			cursor: pointer;
		}
		.modal_galeria{
			position: fixed;
			width: 100%;
			height: 100vh;
			background: rgba(0,0,0,0.9);
			top:0;
			left: 0;
			display: flex;
			justify-content:center;
			align-items:center;
		}
		.modal_img{
			width: 50%;
		}
		.modal_boton{
			width: 50px;
			height: 50px;
			color: #fff;
			font-weight: bold;
			font-size: 25px;
			font-family: monospace;
			line-height: 50px;
			text-align: center;
			background: red;
			border-radius: 50%;
			cursor: pointer;
			position: absolute;
			right: 10px;
			top: 60px;
		}
		/*FIN VISOR DE IMAGENES*/
		#map{
			outline: 2px solid grey;
			
			width: 100%;
			height: 450px;
		}
		iframe{
			width: 100%;
			height: 450px;
		}
		footer{
			 margin-top: 20px;
             /* For Safari 5.1 to 6.0 */
			  background: -webkit-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* Standard syntax */
			  background: linear-gradient(to right,#0981C0,indigo,#B00C7C); 
		}
	</style>
	<script>
		$(function(){
                $('#contenedor img').on({
                    mouseover: function(){
                        $(this).css({
                            'cursor':'pointer',
                            'border-color':'orange'
                        });
                    },
                    mouseout: function(){
                        $(this).css({
                            'cursor':'default',
                            'border-color':'grey'
                        });
                    },
                    click: function(){
                        var UrlImage = $(this).attr('src');
                        $('#principal').fadeOut(300, function(){
                            $(this).attr('src', UrlImage);
                        }).fadeIn(300);
                    }
                });
                /*$(".open").click(function(){
                    $('#bggaleria').fadeIn(300);
                });
                $(".close").click(function(){
                    $('#bggaleria').fadeOut(300);
                });*/
            });
	</script>
	<script>
		$(function() {
	  	  // elementos de la lista
		  var menues = $(".nav li"); 
		  // manejador de click sobre todos los elementos
		  	menues.click(function() {
		     // eliminamos active de todos los elementos
		     menues.removeClass("active");
		     // activamos el elemento clicado.
		     $(this).addClass("active");
		  });

		});
	</script>	
</head>
<body>
	<header>
		@include('templatefront.partials.nav')	
	</header>
	

	<div class="panel panel-default">
	  <div class="panel-heading">Detalle del Inmueble</div>
	  <div class="panel-body">	  	
	  	<div class="row row-detalle">	  		
	  		<!-- <div class="col-md-6">
		  		<ul class="list-group">
				  <li class="list-group-item detalle"><strong>Cod : </strong>{{$property->id}}</li>
				  <li class="list-group-item detalle"><strong>Zona : </strong>{{$property->zone->name}}</li>
				  <li class="list-group-item detalle"><strong>Fecha : </strong>{{$property->admission_date}}</li>
				  <li class="list-group-item detalle"><strong>Precio : </strong>{{$property->sale_price}} $</li>
				  <li class="list-group-item detalle"><strong>Sup. Terreno </strong>{{$property->surface_area}}</li>
				  <li class="list-group-item detalle"><strong>Sup. Contruida </strong>{{$property->surface_builder}}</li>				  
				</ul>
			</div>
			<div class="col-md-6">
		  		<ul class="list-group">
				  <li class="list-group-item detalle"><strong>Precio : </strong>{{$property->sale_price}} $</li>
				  <li class="list-group-item detalle"><strong>Sup. Terreno : </strong>{{$property->surface_area}}</li>
				  <li class="list-group-item detalle"><strong>Sup. Contruida : </strong>{{$property->surface_builder}}</li>
				  <li class="list-group-item detalle"><strong>Descripcion : </strong>{{$property->description}}</li>				  
				</ul>
			</div> -->
			<h3><strong>{{ $property->type_property->name.' en '.$property->category->name }}</strong></h3>
			<p class="itemsproperty"><strong>COD : </strong>{{$property->id}} |
			<strong><i class="fa fa-money fa-2x" aria-hidden="true"></i> : </strong>{{number_format($property->sale_price,0)}} |
			<strong>Sup. Terreno: </strong>{{$property->surface_area}} | 
			<strong>Sup. Contruida: </strong>{{$property->surface_builder}} |
			<strong><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i> Entrega: </strong>{{$property->delivery_time}} |
			<strong><i class="fa fa-car fa-2x" aria-hidden="true"></i> : </strong>{{$property->garages}} |
			<strong><i class="fa fa-bed fa-2x" aria-hidden="true"></i> : </strong>{{$property->bedrooms}} |
			<strong><i class="fa fa-cutlery fa-2x" aria-hidden="true"></i> : </strong>{{$property->kitchens}} |
			<strong>Salas: </strong>{{$property->livingrooms}} | 
			<strong><i class="fa fa-bath fa-2x" aria-hidden="true"></i> : </strong>{{$property->bathrooms}}</p>
			<hr>
			<strong>Descripción: </strong><br><p>{{$property->description}}</p>
	  	</div>
	  	<hr>
	  	<button type="button" class="btn btn-info" id="add">Contactarse</button>
	  	<hr>
		<div class="col-md-6">
				    <!--<a href="#" class="open">
			        <img id="thumbnail" height="350" width="100%" 
			          style="border: 3px solid grey"
			          src="../images/properties/{{$property->images->first()->name}}" />
			    </a>-->	
				<!--<div id="bggaleria">-->
			            <div id="galeria">
			               <!-- <div id="cerrar">
			                    <a href="#" class="close">Cerrar</a>
			                </div>-->
			                <img id="principal" height="350px" width="100%" style="border:3px solid grey" src="../images/properties/{{$property->images->first()->name}}">
			               <br />
			               <div class="row">
				               <div id="contenedor">
				               		<div class="col-md-12 fondo">
					                   	@foreach($property->images as $imagen)
											<img src="../images/properties/{{$imagen->name}}" class="img">
										@endforeach
									</div>
				               </div>
				            </div>
				            <script>
				            	$('#principal').click(function(e){
				            		var img = e.target.src;
				            		var modal = '<div class="modal_galeria" id="modal_galeria"><img src="' + img + '" class="modal_img"><div class="modal_boton" id="modal_boton">X</div></div>';
				            		$('body').append(modal);
				            		$('#modal_boton').click(function(){
				            			$('#modal_galeria').remove();
				            		})
				            	});
				            	$(document).keyup(function(e){
				            		if (e.which==27) {
				            			$('#modal_galeria').remove();
				            		}
				            	})
				            </script>
			            </div>
			    <!--</div>-->
			</div>    
    	
			
			<div class="col-md-6">
				<div id="map">
			    	<!--<iframe src="{{$property->maps}}" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>-->
					<!--{!!$property->maps!!}-->

					<script>
				      function initMap() {
				        var uluru = {lat: {{$property->lat_map}}, lng: {{$property->lng_map}}};
				        var map = new google.maps.Map(document.getElementById('map'), {
				          zoom: 18,
				          center: uluru
				        });
				        var marker = new google.maps.Marker({
				          position: uluru,
				          map: map
				        });
				      }
    				</script>
				    <script async defer
				    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ8D5zq8vK9PnanQ36WW9-DpwI8vmtyB0&callback=initMap">
				    </script>			    
			    </div>
			</div>

	  	@include('newCustomer')

		<!--MENSAJE MODAL-->
	  	<div class="modal fade" id="Success" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Exito!!!!!!</h4>
		        </div>
		        <div class="modal-body">
		          <p>Muchas gracias por registrar sus datos espere a que nos contactemos con Usted.</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
  		</div>	 
		<!--END MENSAJE MODAL-->
	  	<script type="text/javascript">
	  		$.ajaxSetup({
	  			headers: {
	  				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	  			}
	  		})

	    	$('#add').on('click',function(){
	    		$('#buscador').modal('show');
	    	})
	    	$('#frmCustomer').on('submit',function(e){
	    		e.preventDefault();
	    		var form = $('#frmCustomer');
	    		var formData = form.serialize();
	    		var url = form.attr('action');
	    		$.ajax({
	    			type  : 'post',
	    			url   : url,
	    			data  : formData,
	    			async : true,
	    			dataType:'json',
	    			success:function(data){
	    				console.log(data);
	    				$('#frmCustomer').trigger('reset');
	    				$('#first_name').focus();
	    				//$('.modal-dialog').remove();
	    				//$('#myModal').modal('show');	    					
	    				$('#customer').modal('hide'); // or $('#customer').modal('toggle') 
						$('#Success').modal('show');
	    			},
	    			error:function(msj){
	    				console.log(msj.responseJSON.cell_phone);
	    				$("#msj").html(msj.responseJSON.cell_phone);
	    				$("#msj-error").fadeIn();
	    			}
	    		});
	    	})

	    	$('#frmEditCustomer').on('submit',function(e){
	    		e.preventDefault();
	    		var form = $('#frmEditCustomer');
	    		var formData = form.serialize();
	    		var url = form.attr('action');
	    		$.ajax({
	    			type  : 'post',
	    			url   : url,
	    			data  : formData,
	    			async : true,
	    			dataType:'json',
	    			success:function(data){
	    				console.log(data);
	    				$('#frmEditCustomer').trigger('reset');
	    				$('#first_name').focus();
	    				//$('.modal-dialog').remove();
	    				//$('#myModal').modal('show');	    					
	    				$('#existcustomer').modal('hide'); // or $('#customer').modal('toggle') 
						$('#Success').modal('show');
	    			} 
	    		});
	    	})
	    </script>
	    	
	  </div>
	</div>
	
	<!-- <div class="panel panel-default">
		<div class="panel-heading">Fotos y mapa</div>
		<div class="panel-body">
			<div class="col-md-6">
				    
			            <div id="galeria">
			               
			                <img id="principal" height="350px" width="100%" style="border:3px solid grey" src="../images/properties/{{$property->images->first()->name}}">
			               <br />
			               <div class="row">
				               <div id="contenedor">
				               		<div class="col-md-12 fondo">
					                   	@foreach($property->images as $imagen)
											<img src="../images/properties/{{$imagen->name}}" class="img">
										@endforeach
									</div>
				               </div>
				            </div>
				            <script>
				            	$('#principal').click(function(e){
				            		var img = e.target.src;
				            		var modal = '<div class="modal_galeria" id="modal_galeria"><img src="' + img + '" class="modal_img"><div class="modal_boton" id="modal_boton">X</div></div>';
				            		$('body').append(modal);
				            		$('#modal_boton').click(function(){
				            			$('#modal_galeria').remove();
				            		})
				            	});
				            	$(document).keyup(function(e){
				            		if (e.which==27) {
				            			$('#modal_galeria').remove();
				            		}
				            	})
				            </script>
			            </div>
			    
			</div>    
    	
			
			<div class="col-md-6">
				<div id="map">
			    	
					<script>
				      function initMap() {
				        var uluru = {lat: {{$property->lat_map}}, lng: {{$property->lng_map}}};
				        var map = new google.maps.Map(document.getElementById('map'), {
				          zoom: 18,
				          center: uluru
				        });
				        var marker = new google.maps.Marker({
				          position: uluru,
				          map: map
				        });
				      }
    				</script>
				    <script async defer
				    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ8D5zq8vK9PnanQ36WW9-DpwI8vmtyB0&callback=initMap">
				    </script>			    
			    </div>
			</div>
		</div>		
    </div> -->
	<footer>
		<div class="text-center">
			<p class="pull-right"><a href="#">Back to top</a></p>
        	<p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
		</div>        
	</footer>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	
</body>
</html>