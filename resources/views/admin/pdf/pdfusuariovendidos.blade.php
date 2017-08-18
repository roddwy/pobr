<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>REPORTE INMUEBLES VENDIDOS POR MES</title>
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
	<h2>TOTAL VENDIDOS POR USUARIO DE LA FECHA: {{ $date }}</h2>
	<h2 class="usuario">Usuario {{ $usuarioadmin}}</h2>
		@foreach($usuarios as $key => $usuario)	
			<p>{{$usuario->first_name.' '.$usuario->last_name}}</p>
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
					{!! $total = 0 !!}
					{!! $totalprecio = 0 !!}
					{!! $totalcomision = 0 !!}

					@foreach($usuario->properties as $property)
						
						@if($property->state->name == 'Vendido')
							{!! $fecha = new Carbon($property->admission_date) !!}
							{!! $fechaexacta = $fecha->format('y-m') !!}
							@if($date == $fechaexacta)
								<tr>
									<td>{{ $property->id }}</td>
									<td>{{ $property->admission_date }}</td>
									<td>{{ $property->zone->name }}</td>
									<td>{{ $property->street }}</td>
									<td>{{ $property->category->name }}</td>
									<td>{{ $property->type_property->name }}</td>
									<td>{{ $property->owner_current->first_name}}</td>
									<td>{{ $property->owner_current->phone }}</td>
									<td>{{ $property->owner_current->cell_phone }}</td>
									<td>{{ $property->state->name }}</td>
									<td>{{ number_format($property->sale_price,2) }}</td>
									<td>{{ number_format($property->offer_price,2) }}</td>
									<td>{{ number_format($property->comission,2) }}</td>				
								</tr>
								{!! $total = $total + $property->sale_price !!}
								{!! $totalprecio = $totalprecio + $property->offer_price !!}
								{!! $totalcomision = $totalcomision + $property->comission !!}
							@endif
						@endif												
					@endforeach

				</tbody>
				
				<tfoot> 
			        <tr>			        		        	
			           <td colspan="10">TOTALES</td><td>{{number_format($total,2)}}</td>
			           <td>{{ number_format($totalprecio,2) }}</td>
			           <td>{{ number_format($totalcomision,2) }}</td>
			        </tr>
			        <tr>
			           <td colspan="12">TOTAL GANANCIA</td>
			           <td>{{ number_format($totalcomision,2) }}</td>
			        </tr>
		   		</tfoot> 
			</table>
			<br>
		@endforeach
</body>
</html>