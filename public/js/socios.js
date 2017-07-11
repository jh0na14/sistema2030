
$(document).ready(function(){
  $("#tabla").append('<tr id="task"><td>rregre</td><td>');
  $("#fechaNac").mask('xxxx-xxxx');
  
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
$("#btnsavee").click(function (e) {
  $('#frmsocios').submit();
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

                //redirect('/socios');
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
               var errors=data.responseJSON;
                console.log(errors);
                $('#nombrefeed').text(errors.nombre);
                //$( '#nombrediv' ).removeClass();
                $( '#nombrediv' ).addClass("has-danger");
                $( '#apellidodiv' ).addClass("has-danger");
                $('#apellidofeed').text(errors.apellido);
                
                
            }
        });
    });