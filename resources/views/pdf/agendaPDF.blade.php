<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
	<meta charset="utf-8">
 
<title>Agenda</title>
</head>
<body>
	<input type"text" id="etnumAgenda" name="etnumAgenda" value"{{ $idagendas }}">
<table align="center" width="100%">
	<tr>
	<th width="10%;" align="center"><img src="..\public\image\logopp.png" width="75" height="75" class="" alt=""></th>
	<th style="width:80%; text-align:left; padding-left:50px;"><h1>Club Activo 20-30 San Vicente</h1></th>
<th width="10%;" align="center"><img src="..\public\image\sv.jpg" width="75" height="75" class="" alt=""></th>
	
	</tr>
	<td></td>
	<td  align="center"><h2>Agenda #{{ $numAgenda }}</label></h2></td>
	</tr>

</table>
<br>
<div>
<div style="width:70%; float:left; padding-right:0px; font-size:18x; font-weight:bold;" >
	Hora Inicio: @if($horaInicio==null)__________ @else {{$horaInicio}} @endif
</div>

<div style="width:30%; float:right; padding-right:0px; font-size:15px; font-weight:bold;" >
     Fecha: {{$fecha}}
</div>
</div>
<br>
<br>
<div>
<div style="width:100%; float:left; padding-right:0px;" >
  {{-- print_r($array) --}}

<table class="table-bordered" align="center" width="100%">
	<tr>
		
		<th style="text-align: left; width:40%;" ></th>
		{{--<th style="text-align: left; width:20%;" ></th>
		<th style="text-align: left; width:15%;" ></th>
		
		<th style="text-align: left; width:20%;" ></th>
		<th style="text-align: left; width:20%;" ></th>--}}
		
	</tr>
	<div style="display:none;" >{{ $k=0 }} {{ $l=0 }}</div>
	<tbody id="tablaPuntos" name="tablaPuntos">

    {{--	--}} @for ($i = 0; $i < count($array); $i++)
    	<div style="display:none;" >{{ $k++ }}</div>

    	@for ($j = 0; $j < count($array[$i]); $j++)
    	<tr>
    		{{-- @foreach(var_dump($array[$i][$j] as $x => $x_value)
				<td>{{ $x_value }}</td>
    		 @endforeach  --}}
    		@if(hash_equals ($array[$i][$j]['nivel'],'2'))
    			<td style="padding-left:30px;"()>{{ $k }}.{{ $l }} {{ $array[$i][$j]['nombre'] }}. {{-- $array[$i][$j]['descripcion'] --}}</td>
    		@endif
    		@if(hash_equals ($array[$i][$j]['nivel'],'1'))
    		<td><label style="font-weight:bold;">{{ $k }}. {{ $array[$i][$j]['nombre'] }}.</label> {{-- $array[$i][$j]['descripcion'] --}}</td>
			@endif
    		
    	</tr>
    	<div style="display:none;" >{{ $l++ }}</div>
    	
		@endfor
    <div style="display:none;" >{{ $l=0 }}</div>

	@endfor
          
    </tbody>


</table>
<div style="width:90%; float:left; padding-right:0px; font-weight:bold;" align="right" >Hora Fin: @if($horaInicio==null)__________ @else {{$horaFin}} @endif </div>

</div>
</div>

{{--<script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 <script type="text/javascript">
 $(document).ready(function(){
var value=$('#etnumAgenda').val();
  $("#tablaPuntos").empty();
  var row="";
  $.ajax({
        type: "GET",
        url: '/agenda/tablaPuntos/'+value,
        data: value,
        dataType: 'json',
        success: function (data) {
        console.log(data);
        var k=0;
        var l=0;
        for (var i = 0; i < data.length; i++) {
          k++;
          for (var j = 0; j < data[i].length; j++) {
                    
             row +='<tr id="' + data[i][j].id+ '">';
             if(data[i][j].nivel==1){
             row +='<td class="text-center">';
             row +='<button type="button" class="btn btn-outline-primary btn-sm unoAccion" value="' + data[i][j].id + '">1</button> ';
             row +='<button type="button" class="btn btn-outline-info btn-sm dosAccion" value="' + data[i][j].id + '">2</button>';
             row +='</td>';
             row +='<td style="font-weight:bold;">' +k + ' &nbsp&nbsp' + data[i][j].nombre + '</td>';
            }
             if(data[i][j].nivel==2){
             row +='<td class="text-center">';
             row +='</td>';
             row +='<td style="font-weight:bold;">&nbsp&nbsp&nbsp' +k + '.' +l + ' &nbsp&nbsp' + data[i][j].nombre + '</td>';
             //row +='<td>';
            }
               row +='<td>';
            
             row +='</button> ';
             row +='<button type="button" class="btn btn-outline-success btn-sm editPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">Editar';
             row +='</button> ';
             if(data[i][j].descripcion==null){
             row +='<button type="button" class="btn btn-outline-danger btn-sm eliminarPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">x';
             row +='</button> ';
              }else{
              row +='<button type="button" class="btn btn-outline-secondary btn-sm eliminarPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '" disabled>x';
               }
             row +='</td>';
            row +='</tr>';

            
             //if(data[i].motivoCancelacion!=null)
              // row +='<tr><td> Motivo de Cancelacion: </td><td>' + data[i].motivoCancelacion + '</td>' 
            l++;
                 };//fin for 
              //k=0;
              l=0;    
                 };//fin for              
            //row="";
$("#tablaPuntos").append(row);
//or
//$("#tablaPuntos").html(row);



            },//fin ajax 1
        error: function (data) {
            console.log('Error de info boton:', data);
         }
    });
});
  
 </script>--}}
</body>
<footer>

</footer>
</html>
