
<!DOCTYPE html>
<html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Expediente en Línea | Expediente en Línea :: Pagos</title>
      	{{-- link de boostrap 4--}}
      	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  
 {{-- --}}
  
  
       <!-- <script type="text/javascript" src="/js/helper.js"></script>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Universidad de El Salvador, Inscripción en Línea">
        <meta name="author" content="Departamento de IT - UES 2016">-->
    </head>
    <body>
    	<nav class="navbar navbar-light bg-faded" >
  <a class="navbar-brand" href="#">
    <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    <span >Club Activo 20-30</span>
  </a>
</nav>

        
<div class="row">


</div>
<div class="container" >
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	<ul class="nav nav-tabs">
		<li class="nav-item  active">
			<a class="nav-link active" href="/pagos/pagoAnho">{{$tipoSocio}}</a>
		<li>
	</ul>
<button type="button" class="btn btn-outline-info btn-sm "data-toggle="modal" data-target="#myModal" >ADD</button>

  <div style="clear:both; padding-bottom:15px;">
  </div>
	<div style="width:14%; float:left; padding-right:0px;" id="menu-vertical-pagos">
			{{--<div class="list-group" style="padding-bottom:25px;">
			<a href="/pagos/index/" class="list-group-item active">Carreras</a>
	 		<a href="/pagos/index/1092" class="list-group-item">Ingeniería de Sistemas Informáticos</a>
	 	</div>--}}
		<div class="list-group " class="padding-bottom:25px;">
			<li href="/pagos/index/" class="list-group-item active">Tipo de Socio{{--A&ntilde;os--}}</li>
				

				<div><a href="/socios/1" class="list-group-item list-group-item-action justify-content-between">Socio Activo<span class="badge badge-default badge-pill">{{$count0}}</span></a></div>
				<a href="/socios/2" id="activoMayor" class="list-group-item justify-content-between">Activo Mayor <span class="badge badge-default badge-pill">{{$count}}</span></a>
				{{--<a href="/pagos/pagoAnho/2015/1092/grado" class="list-group-item justify-content-between">Inactivos<span class="badge badge-default badge-pill">{{$count}}</span></a>
				--}}
			</div>	
	</div>
	
	<div style="width:85%; float:right;" id="contenido-pagos">
	   
 
<table class="table {{--table-bordered--}} table-hover table-sm " align="center">
	<thead >
	        <tr>
	            <th colspan="5" style="text-align:center; font-weight:bold; letter-spacing:5px;"><label id="tipoSocio">{{strtoupper($tipoSocio)}}</label> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>	
	            </th>
	        
	        </tr>
	</thead>
	<thead >
	        <tr >
	            <th class="center ">Nombre</th>
	           	<th>Apellido</th>
	           	
	           	{{--<th>A&ntilde;o</th>--}}
	           	<th style="text-align: center">apodo</th>
	           	<th>Fecha</th>
	           	{{--<th style="text-align: center">Tipo</th>
	           	--}}<th>Cargo</th>
	           	<th style="text-align: center">Estado</th>
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($socios as $socio)
		<tr id="{{ $socio->idsocios }}">
			<td style="padding:7px">{{ $socio->nombre }}</td>
			<td>{{ $socio->apellido }}</td>
			{{--<td>2017</td>--}}
			<td class="text-center">{{ $socio->apodo }}</td>
			<td>{{ $socio->fechaNac }}</td>
			{{--<td class="text-center">{{ $socio->tipoSocio }}</td>
			--}}<td class="text-center">CANCELADO</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm " id="myBtn2" data-toggle="modal" data-target="#myModal">Editar</button>
				<button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
			</tbody>

</table>


{{-- //////////////////////////MODAL -}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Task Editor</h4>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                            <input type="hidden" id="task_id" name="task_id" value="0">
                        </div>
                    </div>
                </div>
       </div>
   </div>
{{-- //////////////FIN MODLA--}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>	
{{-- /////////////////////FIN--}}
	{{--@if(count($socios))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $socios->links('
  pagination::bootstrap-4') }}
  </div>
  

	{{----}}</div>
	
	
	<div style="clear:both;"></div>
</div>
<div class="push"></div>
	
<div >
    <hr>
    <footer>
        <p style="padding-left:25px;">DTI &copy; Universidad de El Salvador 2017</p>
    </footer>
</div>




<!-- Amplio el Alto al 90% -->
<style type="text/css">
    html, body {
    	height: 100%;
		margin: 0px;
		font-size: 14px;
	}
	.container {
		min-height: 90%;
    	height: auto !important;
    	height: 100%;
    	margin: 0 auto -90px;
	}
	table,th,td{
		padding: 0px;
		margin: 0px;
	}
	
	footer {
        height: 80px;
        width: 100%;
	}
	
	.push {
		height: 80px;
	}
</style>
{{-- --}}
   <script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
$(document).ready(function(){
	$("#tabla").append('<tr id="task"><td>rregre</td><td>');


	/*$('#myModal').modal('toggle');
 $('.modal').modal('show');

	$('#myModal').modal({
 
});*/
   });

function openModal(){

    $('#myModal').modal();
}       
 

 $("#myBtn").click(function(){
    	$("#tabla").append('<tr id="task"><td>rregre</td><td>');

        $("#tabla").detach();
    	$("#myModal").show('show');
    });

</script>



    </body>
  
</html>