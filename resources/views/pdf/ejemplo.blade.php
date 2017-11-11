<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
<title> reporte</title>
</head>
<body>
<h1>pdh salio :D</h1>
<table>
	<tr>
		<td>id</td>
		<td>nombre</td>
		<td>monto</td>
	</tr>
	@forelse($verdugos as $socio)
		<tr id="trow{{$socio->id}}">
			<td style="padding:6px">{{ $socio->id }}</td>
			<td>{{ $socio->montoRecaudado }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-warning btn-sm pagosAccion" value="{{ $socio->id }}" >Pagos</button>
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $socio->id }}">Info</button>				
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
</table>
</body>
</html>
