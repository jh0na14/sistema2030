<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
	<meta charset="utf-8">
 
<title>Donaciones</title>
</head>
<body>
<table align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>

	</tr>
	<tr>
		<h2 align="center">Resumen de Donaciones {{ $tipo }}</h2>
		
		
	</tr>
</table>
<h3 align="center">Periodo {{ $periodo }}</h3>
<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >

<table class="table-bordered" align="center" width="100%">
	<tr>
		
		<th style="text-align: left; width:20%;" >Fecha</th>
		<th style="text-align: left; width:25%;" >Descripcion</th>
		<th style="text-align: left; width:15%;" >Monto</th>
		<th style="text-align: left; width:20%;" >Categoria</th>
		@if($tipo=="Recibida")
		<th style="text-align: left; width:20%;" >Patrocinador</th>
		@endif
	</tr>
	@forelse($donaciones as $donacion)
		<tr id="trow{{$donacion->id}}">
			<td align="left">{{ $donacion->fecha }}</td>
			<td align="left">{{ $donacion->descripcion }}</td>
			<td style="padding:6px;" align="left">{{ $donacion->monto }}</td>
			<td align="left">{{ $donacion->tipo }}</td>
			@if($donacion->tipo=="Recibida")
			<td align="left">{{ $donacion->nombre }}</td>
			@endif
        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse

</table>
</div>
</div>


</body>
</html>
