<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte VENDIDOS</title>
	<style type="text/css">
		table tr th{
		    background-color: #000;
		    color: #fff;
		    font-size: 10px;
		}
		table tr td{
		    background-color: #eee;
		    font-size: 10px;
		}
		tfoot{
			background: #000;
			color: #fff;
		}
		h1{
			background-color: #000;
			height:40px;
			margin-bottom: 0px;
			text-align: center;
			color: #fff;
		}
		h2{
			font-size: 15px;
			position: fixed;
			text-align: center;
			top: 60px;
		}
		.usuario{
			font-size: 15px;
			position: fixed;
			text-align: center;
			top: 85px;
		}
	</style>
</head>
<body>
	<h1>ORION BIENES RAICES</h1>	
	<img src="images/menu/icono.png">
	<h2>TOTAL INMUEBLES VENDIDOS DE LA FECHA: {{ $date }}</h2>
	<h2 class="usuario">Usuario {{ $user }}</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>FECHA</th>
				<th>ZONA</th>
				<th>CALLE</th>
				<th>CATEGORIA</th>
				<th>TIPO</th>
				<th>PROPIETARIO</th>
				<th>TELEF PROPIETARIO</th>
				<th>CEL PROPIETARIO</th>
				<th>ESTADO</th>
				<th>PRECIO VENTA</th>
				<th>PRECIO OFERTA</th>
				<th>COMISSIÓN</th>
			</tr>
		</thead>
		<tbody>
		@foreach($properties as $key => $property)	
			<tr>
				<td>{{ $property->id }}</td>
				<td>{{ $property->admission_date }}</td>
				<td>{{ $property->nombrezona }}</td>
				<td>{{ $property->street }}</td>
				<td>{{ $property->nombrecategoria }}</td>
				<td>{{ $property->nombretipo }}</td>
				<td>{{ $property->nombreprop.' '.$property->apellidoprop }}</td>
				<td>{{ $property->phone }}</td>
				<td>{{ $property->cell_phone }}</td>
				<td>{{ $property->name }}</td>
				<td>{{ number_format($property->sale_price,2) }}</td>
				<td>{{ number_format($property->offer_price,2) }}</td>
				<td>{{ number_format($property->comission,2) }}</td>
			</tr>
		@endforeach
		</tbody>
		
		<tfoot> 
	        <tr> 	        	
	           	<td colspan="10">TOTALES</td><td>{{$total}}</td>
	           	<td>{{$totalofertas}}</td>
	           	<td>{{$totalcomisones}}</td>
	        </tr> 
   		</tfoot> 
	</table>
</body>
</html>