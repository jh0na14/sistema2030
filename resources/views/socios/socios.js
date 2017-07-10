<script type="text/javascript">

$(document).ready(function(){
  $("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$('#myModal').modal('toggle');
    //$('.modal').modal('show');  
   });    

 $(".infomodal").click(function(){
      $("#tabla").append('<tr id="task"><td>info</td><td>');
       var socio_id = $(this).val();
       //$('#nombrediv').text("ldjkds");
         //$('#apellidodiv').text("dckjdsjknds");   
            //$('#myModal').modal('show'); 

/*         
///////////////////////Otra forma de realizar el get ajax
$.get('/socios/buscar/' + socio_id, function (data) {
          //success data
          var datasrvr=data;

            console.log(data);
            $('#nombrediv').text(data.nombre);
                $('#apellido').text(data.apellido);
            
            $('#myModal').modal('show'); 
            
        });
 */    
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

   


 $("#myBtn").click(function(){
      $("#tabla").append('<tr id="task"><td>rregre</td><td>');

        $("#tabla").detach();
      $("#myModal").show('show');
    });

 $(".editModal").click(function(){
  $("#tabla").append('<tr id="task"><td>"'+$("#btnsave").val()+'"</td><td>');

   $('#exampleModal').modal('show');
     
   $("#btnsave").innerHTML="Modificar";
      
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
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        //var task_id = $('#task_id').val();;
        var my_url = "/socios/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + task_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);

        
                var row = '<tr><td>' + data.apodo + '</td>';
                 row +='<td>' + data.nombre + '</td>';
         row +='<td>' + data.apellido + '</td>';
         row +='<td>' + data.email + '</td>';
         row +='<td>' + data.cargo + '</td>';       
         row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.idsocios+'">Info</button>  ';
         row += '<button type="button" class="btn btn-outline-success btn-sm " data-toggle="modal" data-target="#exampleModal" value="'+data.idsocios+'">Editar</button>  ';
         row +='<button type="button" class="btn btn-outline-danger btn-sm" value="'+data.idsocios+'">Eliminar</button>';
         row +='</td></tr>';
        //var task='<tr id="task"><td>rregre</td><td>';
        $("#tabla").append(row);
                
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
