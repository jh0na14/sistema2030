<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
	<meta charset="utf-8">

	{{--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
--}}
	<title>Gastos e Ingresos</title>
</head>
<body>
<table  align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>
	<th width="10%;" align="center"><img src="..\public\image\sv.jpg" width="75" height="75" class="" alt=""></th>
	
	</tr>
	<tr>
		<h2 align="center">Tesoreria {{ $tipo }}</h2>
		
		
	</tr>
</table>
<h3 align="center">Periodo {{ $periodo }}</h3>
<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >
<table  class="table table-bordered" align="center" width="100%">
	<tr style="border:1px solid black;">
		
		<th style="text-align: left; width:20%;" >Fecha</th>
		<th style="text-align: left; width:35%;" >Concepto</th>
		<th style="text-align: left; width:15%;" >Ingreso</th>
		<th style="text-align: left; width:15%;" >Egreso</th>
		<th style="text-align: left; width:15%;" >Saldo</th>
	</tr>
	@forelse($tablas as $tabla)
		<tr {{--style="border:1px solid black;"--}} id="trow{{$tabla->id}}">
			<td  align="left">{{ $tabla->fecha }}</td>
			<td align="left">{{ $tabla->concepto }}</td>
			<td style="padding:6px;" align="left">$ {{ $tabla->ingreso }}</td>
			<td align="left">$ {{ $tabla->egreso }}</td>
			<td align="left">$ {{ $tabla->saldo }}</td>
			<button type="button" class="btn btn-default navbar-btn">Sign in</button>
        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse

</table>
</div>
</div>



</body>
</html>
