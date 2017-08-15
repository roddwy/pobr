<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Default') | Panel Administrador</title>
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<style>
		body{
			background: #fff;
		}
		nav.navbar {
    			margin-bottom: -20px;
			/*background-color: #BB1F35;*/
			  background: -webkit-linear-gradient(left,#0784F1,#0784F1,#0784F1);
			  /* For Opera 11.1 to 12.0 */
			  background: -o-linear-gradient(left,#0784F1,#0784F1,#0784F1);
			  /* For Fx 3.6 to 15 */
			  background: -moz-linear-gradient(left,#0784F1,#0784F1,#0784F1);
			  /* Standard syntax */
			  background: linear-gradient(to right,#0784F1,#0784F1,#0784F1);
    			
		}	
		/*COLOR TITULO NAVBAR*/
		nav.navbar a{
			color:#000000;
		}
		/*END TITULO NAVBAR*/
		/*COLOR DE LETRAS DEL NAVBAR*/
		.navbar-inverse .nav li a{
		  color: #000;
		}
		/*Mouse encima*/
		.navbar-inverse .nav li a:hover{
		  color: #fff;
		}
		section {
			margin: 2%;
			padding: 0;
			background-color: #E8E6E7;
		}
		form {
				margin:0px;
				background-color: #E8E6E7;
			}
		table{
			margin:20px;
			 
		}
		div.pagination{
			margin-left: 180px;
			background-color:#000;
		}
		.login{
			margin: 10%;
		}

		
	</style>
	<script type="text/javascript">
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
</head>
<body>
	@include('admin.template.partials.nav')
	<section>
		
		@yield('content')
	</section>
	<script src="{{ asset('plugins/jquery/js/jquery-3.2.0.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>