<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
	<meta charset="utf-8">
 
<title>Socios</title>
</head>
<body>
<table align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>

	</tr>
	<tr>
		<h2 align="center">Total de Socios Activos</h2>
	</tr>

</table>

<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >

<table class="table-bordered" align="center" width="100%">
	<tr>
		
		<th style="text-align: left; width:30%;" >Nombre</th>
		<th style="text-align: left; width:25%;" >Email</th>
		<th style="text-align: left; width:30%;" >Apodo</th>
		{{--
		<th style="text-align: left; width:15%;" >Telefono</th>--}}
		<th style="text-align: left; width:15%;" >Tipo Socio</th>
		
	</tr>
	@forelse($socios as $socio)
		<tr id="trow{{$socio->id}}">
			<td align="left">{{ $socio->nombre }} {{ $socio->apellido }}</td>
			<td align="left">{{ $socio->email }}</td>
			<td style="padding:6px;" align="left">{{ $socio->apodo }}</td>
			{{--
			<td align="left">{{ $socio->telefono }}</td> --}}
			<td align="left">{{ $socio->tipoSocio }}</td>
        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse

</table>
</div>
</div>


</body>
</html>
