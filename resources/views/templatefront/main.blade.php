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
			background-color: #BECEBB;
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
		section {
			margin: 0%;
			padding: 0%;
			background-color: rgba(0,0,0,.8);
		}

		.row{
			padding:1%;
		}
		.row-inmuebles{
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
			font-family: Elephant;
			color: #BECEBB;
			font-size: 30px;

		}
		.tituloprincipal
		{
			font-family: Elephant;
			color: #BECEBB;
		}
		.rowtitulo{
			  /* For Safari 5.1 to 6.0 */
			  background: -webkit-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* Standard syntax */
			  background: linear-gradient(to right,#0981C0,indigo,#B00C7C); 
			margin: 0;
			padding: 5px;
		}
		
		.navbar{
			margin-bottom: -20px;
			/*background-color: #BB1F35;*/
			background: -webkit-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#0981C0,indigo,#B00C7C);
			  /* Standard syntax */
			  background: linear-gradient(to right,#0981C0,indigo,#B00C7C); 

		}
		/*COLOR TITULO NAVBAR*/
		.navbar-brand .navbar-header a{
			color:#000000;
		}
		/*END TITULO NAVBAR*/
		/*COLOR DE LETRAS DEL NAVBAR*/
		.navbar-inverse .nav li a{
		  color: #BECEBB;
		}
		/*Mouse encima*/
		.navbar-inverse .nav li a:hover{
		  color: #FFFFFF;
		}
		/*END COLOR DE LETRAS DEL NAVBAR*/
		.col-md-12{
			padding: 0;
		}			
		.thumbnail{
			background: #fff;
			margin-top: 0px;
			margin-left: 15px;
			margin-right: 0px;
			
			padding: 0px;
		}
		.img-principal{
			max-height: 150px;
			max-width: 200px;
			position: relative;
		}
		.infoinmueble{
		      position:absolute;
		      bottom:100px;
		      width:50%;		     
		      text-align:center;
		      color:rgba(243,243,243,.8);
		      font-family:Verdana;
		      font-size:14px;
		      font-style: italic;
		      background-color:rgba(0,0,0,.4);
		      padding:.5em 0;
		      /*transform: rotate(-50deg);*/
		}
		.ofertainmueble{
		      position:absolute;
		      bottom:145px;
		      left:60px;
		      width:50%;		     
		      text-align:center;
		      color:rgba(247,244,20,.8);
		      font-family:Impact, Charcoal, sans-serif;
		      font-size:35px;
		      font-style: italic;
		      
		      padding:.5em 0;
		      
		}
		.btnmasinformacion{
			width: 100%;
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
			background: #B00C7C;
			margin:0px;
		}
		.navbar-form{
			background: -webkit-linear-gradient(left,#FFFFFF,indigo,#FFFFFF);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#FFFFFF,indigo,#FFFFFF);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#FFFFFF,indigo,#FFFFFF);
			  /* Standard syntax */
			  background: linear-gradient(to right,#FFFFFF,indigo,#FFFFFF); 
			padding: 15px;
		}

		.form-control{
			background: #EBE6E7;
			margin-right: 20px;
		}
		.cinta {
			position:relative;
			width:100%;
			height:25px;
			margin:auto;
			text-align:center;
			border:2px solid #BB1F35;
			background-color: yellow;
			/*background-image: linear-gradient(90deg, #BB1F35, #FFFFFF);*/
			background-image: linear-gradient(0deg, rgba(255, 255, 255, .2) 50%, transparent 50%, transparent);
			background-size: 4px 4px;
		}
		/*.cinta:before {
			content:" ";
			position:absolute;
			display:block;
			width:0px;
			height:0px;
			top:11px;
			left:-25px;
			border-color:#BB1F35 #BB1F35 #BB1F35 transparent;
			border-style:solid;
			border-width:12px;
		}*/
		.cinta span {
			text-transform:uppercase;
			font-family:arial;
			font-size:20px;
			font-weight:bold;
			line-height:22px;
			color: block;
			text-shadow: 1px 2px 3px grey;
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
		$(document).ready(function() {
		var url = window.location.pathname, 
		    urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
		    $('.nav li a').each(function(){
		        if(urlRegExp.test(this.href.replace(/\/$/,''))){
		            $('.nav li').removeClass('active');
		            $(this).parent('li').addClass('active');
		        }
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

	<footer>
		@include('templatefront.partials.footer')
	</footer>
	
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

</body>
</html>