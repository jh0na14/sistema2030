<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
	<meta charset="utf-8">
 
<title>Pagos</title>
</head>
<body>
	
<table align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>
<th width="10%;" align="center"><img src="..\public\image\sv.jpg" width="75" height="75" class="" alt=""></th>
	
	</tr>
	{{--<tr>
		<td>Pagos de Socio {{ $nombre }} {{ $apellido }}</td>
		<td><label>Deuda: {{$deuda}}</label></td>
	</tr>--}}

</table>
<br>
<br>
<div>
<div style="width:70%; float:left; padding-right:0px; font-size:20px; font-weight:bold;" >
	<div align="center">Pagos de Socio {{ $nombre }} {{ $apellido }}</div>
</div>

<div style="width:30%; float:left; padding-right:0px; font-size:20px; font-weight:bold;" >
	Deuda : {{$deuda}}
</div>
</div>
<br>
<br>
<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >

<table class="table-bordered" align="center" width="100%">
	<tr>
		
		<th style="text-align: left; width:40%;" >Mes</th>
		<th style="text-align: left; width:20%;" >Monto</th>
		{{--<th style="text-align: left; width:15%;" >Año</th>
		--}}
		<th style="text-align: left; width:20%;" >Fecha Pago</th>
		<th style="text-align: left; width:20%;" >Estado</th>
		
	</tr>
	<tbody id="tabla" name="tabla">
    <div style="display:none;">{{ $contador=0 }}</div>
    @forelse($pagos as $pago)
    <tr id="trow{{ $pago->id }}">
      <td style="font-size:14px">Cúota {{ $pago->numMes }},  mes {{ $pago->mes }}</td>
      <td style="text-align: left;">$ {{ $pago->monto }}</td> 
      {{--<td class="text-center">{{ $pago->año }}</td>
      --}}<td class="text-center" >{{ $pago->fechaPago }}</td>
      {{-- $contador++ --}}
      
      <td class="text-center @if($pago->estado=='CANCELADO') text-secondary @else text-danger @endif "  style="font-size:13px">{{ $pago->estado }}</td>

        </tr>
        {{--@if($contador==12)
        	<tr>
		
		<th style="text-align: left; width:40%;" >Mes</th>
		<th style="text-align: left; width:15%;" >Monto</th>
		<th style="text-align: left; width:15%;" >Año</th>
		
		<th style="text-align: left; width:15%;" >Fecha Pago</th>
		<th style="text-align: left; width:15%;" >Estado</th>
		
	</tr>
        @endif--}}
    @empty
      <p>No hay mensajes destacados</p>
      @endforelse
            
    </tbody>


</table>
</div>
</div>

<script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 
</body>
</html>
