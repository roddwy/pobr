<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Default') | Panel Administrador</title>
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
	<style>
		body{
			background: #fff;
		}
		nav.navbar {
    			background-color: #C25C53;
    			margin-right: 2%;
    			margin-left: 2%;
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