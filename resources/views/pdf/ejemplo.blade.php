<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>

<title> reporte</title>
</head>
<body>
<table align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>

	</tr>
	<tr>
		<h2 align="center">Agenda #45</h2>
	</tr>

</table>

<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >

<table class="table-bordered" align="center" width="100%">
	<tr>
		<th style="text-align: center; width:10%;" >id</th>
		<th style="text-align: center; width:40%;" >Monto Recaudado</th>
		<th style="text-align: center; width:40%;" >Monto Rifa</th>
	</tr>
	@forelse($verdugos as $socio)
		<tr id="trow{{$socio->id}}">
			<td style="padding:6px;" align="center">{{ $socio->id }}</td>
			<td align="center">{{ $socio->montoRecaudado }}</td>
			<td align="center">{{ $socio->montoRifa }}</td>
			
			{{--<td class="text-center">
				<button type="button" class="btn btn-outline-warning btn-sm pagosAccion" value="{{ $socio->id }}" >Pagos</button>
						</td>
--}}
        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse

</table>
</div>
</div>
</body>
</html>
