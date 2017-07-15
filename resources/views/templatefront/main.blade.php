<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Default') | ORION BIENES RAICES</title>
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<style>
		body{
			background-color: #BDBDBD;
		}
		h1{
			color:#fff;
			margin-top:10px;
			margin-bottom: 10px;
			font-family: 'Anton', sans-serif;			
		}
		h3{
			font-size: 20px;
			font-family: 'Anton', sans-serif;
		}
		.row{
			padding:1%;
		}
		.col-md-6{
			padding-left: 0;
		}
		.linavbar{
			font-family: 'Fjalla One', sans-serif;
			font-size: 20px;
		}
		.titulonavbar{
			font-family: 'Anton', sans-serif;
			font-size: 30px;
		}
		.rowtitulo{
			background: #BB1F35;
			margin: 0;
			padding: 5px;
		}
		.oferta{
			background: yellow;
		}
		.navbar{
			margin-bottom: -20px;
			background-color: #BB1F35;
		}
		
		.col-md-12{
			padding: 0;
		}	

		.img-principal{
			max-height: 150px;
			max-width: 150px;
		}
		
		section {
			margin: 0%;
			padding: 0%;
			background-color: #EBE6E7;
		}
		.thumbnail{
			background: #fff;
			margin-top: 10px;
			margin-left: 10px;
			padding: 10px;
		}
		form {
				margin:25px;
				background-color: #E8E6E7;
			}
		table{
			margin:20px;
			background-color:#E8E6E7; 
		}
		div.pagination{
			margin-left: 180px;
			background-color:#000;
		}
		
		.form-group{
			background: #BB1F35;
			margin:0px;
		}
		.navbar-form{
			background: #873838;
			padding: 15px;
		}
		.form-control{
			background: #EBE6E7;
			margin-right: 20px;
		}
		
		footer{
			background: #BB1F35;
		}
	</style>
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
	@yield('mapa')
</head>
<body>
	<header>
		@include('templatefront.partials.nav')
		@include('templatefront.partials.carousel')
	</header>
	
	
	<section>
		
		@yield('content')
	</section>

	
	
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

</body>
</html>