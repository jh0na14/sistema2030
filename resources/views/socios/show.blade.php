
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
<!-- Amplio el Alto al 90% -->
<style type="text/css">
    html, body {
    	height: 100%;
		margin: 0px;
		font-size: 15px;
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
	.modal .modal-body {
    max-height: 450px;
    overflow-y: auto;
}
//Estos 3 webkits es para cambiar el look de el scrooll
::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
	background-color: #FFFFFF;
	border: 2px solid #DDDFFF;
}


</style>

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

  <div style="clear:both; padding-bottom:15px;">
  </div>
	<div style="width:14%; float:left; padding-right:0px;" id="menu-vertical-pagos">
			<button type="button" style="margin-left:100%" class="btn btn-outline-info btn-sm " data-toggle="modal" data-target="#myModal" >Nuevo Socio</button>
<div style="clear:both; padding-bottom:15px;">
  </div>
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
	            <th colspan="5" style="text-align:center; font-weight:bold; letter-spacing:5px;"><label >{{strtoupper($tipoSocio)}}</label> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
	            	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
					  Launch demo modal
					</button>	
	            </th>
	        
	        </tr>
	</thead>
	<thead >
	        <tr >
	        	<th style="text-align: center">Apodo</th>
	           	
	            <th class="center ">Nombre</th>
	           	<th class="center ">Apellido</th>
	           	
	           	{{--<th>A&ntilde;o</th>--}}
	           	<th>Email</th>
	           	{{--<th style="text-align: center">Tipo</th>
	           	--}}<th class="center ">Cargo</th>
	           	<th style="text-align: center">Estado</th>
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($socios as $socio)
		<tr id="{{ $socio->id }}">
			<td style="padding:6px">{{ $socio->apodo }}</td>
			<td>{{ $socio->nombre }}</td>
			{{--<td>2017</td>--}}
			<td >{{ $socio->apellido }}</td>
			<td>{{ $socio->email }}</td>
			{{--<td class="text-center">{{ $socio->tipoSocio }}</td>
			--}}<td >{{ $socio->cargo }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $socio->id }}">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $socio->id }}">Editar</button>
				<button type="button" class="btn btn-outline-danger btn-sm" value="{{ $socio->id }}">Eliminar</button>
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
	</tbody>


</table>
{{--@if(count($socios))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $socios->links('
  pagination::bootstrap-4') }}
  </div>


{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Datos Personales</h4>
                        </div>
                        <div class="modal-body">
                            <div class="">
            					<table   class="table {{--table-bordered--}}  table-sm " align="center">
            					<tbody id="tablainfo">
            					</tbody>
            					</table>
					        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add" data-toggle="modal" data-target="#exampleModal">Save changes</button>
                           
                        </div>
                    </div>
                </div>
       </div>
   </div>
{{-- //////////////FIN MODLA--}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            @include('socios.form')
        </div>
      </div>
      <div class="modal-footer">
      	 <input type="hidden" id="socio_id" name="socio_id" value="0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave" value="Anhadir">Save changes</button>
      </div>
    </div>
  </div>
</div>	
{{-- /////////////////////FIN--}}
	
  

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

{{-- --}}
<meta name="_token" content="{{ csrf_token() }}">
  <script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 {{-- <script src="{{asset('js/ajax-crud.js')}}"></script>--}}

<script type="text/javascript">

$(document).ready(function(){
	$("#tabla").append('<tr id="task"><td>rregre</td><td>');
	//$('#myModal').modal('toggle');
    //$('.modal').modal('show');	
   });    
 $("#btnnuevo").click(function(){

 	$('#btnsave').val("add");
 	$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frmsocios').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

///////////editodal el boton es la clase infomodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
 $(".infomodal").click(function(){
    	$("#tabla").append('<tr id="task"><td>info</td><td>');
    	 var socio_id = $(this).val();
    	 //$('#nombrediv').text("ldjkds");
         //$('#apellidodiv').text("dckjdsjknds");   

   			$("#tablainfo").empty();
   			$.ajax({

            type: "GET",
            url: '/socios/buscar/'+socio_id,
            data: socio_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
				$('#nombrediv').text(data.nombre);
           	    $('#apellidodiv').text(data.apellido);

           	    var row = '<tr><td> Nombre: </td><td>' + data.nombre + '</td>';
           	     row +='<tr><td> Apellido: </td><td>' + data.apellido + '</td>';
				 row +='<tr><td> Apodo: </td><td>' + data.apodo + '</td>';
				 row +='<tr><td> Fecha de Nacimiento: </td><td>' + data.fechaNac + '</td>';
			     row +='<tr><td> DUI: </td><td>' + data.dui + '</td>';
				 row +='<tr><td> Direccion: </td><td>' + data.direccion + '</td>';
				 row +='<tr><td> Telefono: </td><td>' + data.telefono + '</td>';
				 row +='<tr><td> Email: </td><td>' + data.email + '</td>';
				 row +='<tr><td> Tipo de Socio: </td><td>' + data.tipoSocio + '</td>';
				 row +='<tr><td> Cargo: </td><td>' + data.cargo + '</td>';
           	      $("#tablainfo").append(row);            
            
            },
            error: function (data) {
                console.log('Error de info boton:', data);
            }
       });
   $('#myModal').modal('show'); 
    });

///////////editodal el boton es la clase editmodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
 $(".editModal").click(function(){
 	var socio_id = $(this).val();
 		$("#socio_id").val(socio_id);
		
		//Otra forma de realizar el get ajax el mismo de infomodal 		
 		$.get('/socios/buscar/' + socio_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
        	$('#apellido').val(data.apellido);
        	$('#fechaNac').val(data.fechaNac);
        	$('#dui').val(data.dui);
        	$('#direccion').val(data.direccion);
        	$('#telefono').val(data.telefono);
        	$('#email').val(data.email);
        	$('#apodo').val(data.apodo);
        	$('#tipoSocio').val(data.tipoSocio);
        	$('#cargo').val(data.cargo);//enum    
        });
 		//El boton para saber cambair de estado para guardar o modificar 
 		$("#btnsave").val("update")
 		$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#socio_id").val() +'</td><td>');

	   $('#exampleModal').modal('show');
	   //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
	   $("#btnsave").html("Modificar");
    	
    });

  $("#btnsave").click(function (e) {
  	//$("#tabla").append('<tr id="task"><td>"'+document.getElementById("messageform").value+'"</td><td>');
	//$("#tabla").append('<tr id="task"><td>"'+document.getElementById("nombre").value+'"</td><td>');
      //$('#frmsocios').submit();  
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
        	//nombre:document.getElementById("nombre").value,
        	nombre:$('#nombre').val(),
        	apellido:$('#apellido').val(),
        	fechaNac:$('#fechaNac').val(),
        	dui:$('#dui').val(),
        	direccion:$('#direccion').val(),
        	telefono:$('#telefono').val(),
        	email:$('#email').val(),
        	apodo:$('#apodo').val(),
        	tipoSocio:$('#tipoSocio').val(),
        	cargo:$('#cargo').val(),//enum       
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var socio_id = $('#socio_id').val();;
        var my_url = "/socios/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/socios/update/'+socio_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);

               	redirect('/socios');
        		if(state=="add"){
           	    var row = '<tr><td>' + data.apodo + '</td>';
           	     row +='<td>' + data.nombre + '</td>';
				 row +='<td>' + data.apellido + '</td>';
				 row +='<td>' + data.email + '</td>';
				 row +='<td>' + data.cargo + '</td>';       
				 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
				 row += '<button type="button" class="btn btn-outline-success btn-sm " data-toggle="modal" data-target="#exampleModal" value="'+data.id+'">Editar</button>  ';
				 row +='<button type="button" class="btn btn-outline-danger btn-sm" value="'+data.id+'">Eliminar</button>';
				 row +='</td></tr>';
				//var task='<tr id="task"><td>rregre</td><td>';
				$("#tabla").append(row);
               }
                /*if (state == "add"){ //if user added a new record
                    $('#tasks-list').append(task);
                }else{ //if user updated an existing record

                    $("#task" + task_id).replaceWith( task );
                }*/

               // $('#frmsocios').trigger("reset");

               // $('#exampleModal').modal('hide')
            },
            error: function (data) {
                console.log('Error de noseq:', data);
            }
        });
    });

</script>


    </body>
  
</html>