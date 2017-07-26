
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
  
  //$('#myModal').modal('toggle');
    //$('.modal').modal('show');  
   });   
////////////////Esto para busqueda
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/socios/busqueda/'+value,
            data: {'search':value},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                 $("#tabla").html(data);            
            
            },
            error: function (data) {
                console.log('Error de info boton:', data);
            }
       });
 });
///////////////////fin busqueda

 $("#btnnuevo").click(function(){

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Socio");
  $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frmsocios').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

///////////editodal el boton es la clase infomodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
$(document).on('click','.infomodal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
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
        
                var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.nombre + '</td>';
                 row +='<tr><td> Apellido: </td><td>' + data.apellido + '</td>';
         row +='<tr><td> Apodo: </td><td>' + data.apodo + '</td>';
         row +='<tr><td> Fecha de Nacimiento: </td><td>' + data.fechaNac + '</td>';
           row +='<tr><td> DUI: </td><td>' + data.dui + '</td>';
         row +='<tr><td> Direccion: </td><td>' + data.direccion + '</td>';
         row +='<tr><td> Telefono: </td><td>' + data.telefono + '</td>';
         row +='<tr><td> Email: </td><td>' + data.email + '</td>';
         row +='<tr><td> Tipo de Socio: </td><td>' + data.tipoSocio + '</td>';
         row +='<tr><td> Cargo: </td><td>' + data.cargo + '</td>';
         row +='<tr><td> Estado: </td><td>' + data.estado + '</td>';
         
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
$(document).on('click','.editModal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick 
// $(".editModal").click(function(){
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
    $("#btnsave").val("update");
    $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#socio_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar Socio");
      
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
          //socio:$('#socio_id').val(),
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
                 row += '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'+data.id+'">Editar</button>  ';
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
                if(errors.nombre!=undefined)
                {
                  $('#nombrefeed').text(errors.nombre);
                  //$( '#nombrediv' ).removeClass();
                  $( '#nombrediv' ).addClass("has-danger");
                }else{
                  $( '#nombrediv' ).removeClass("has-danger");
                  $( '#nombrefeed' ).text("");
                  }
                  
                if(errors.apellido!=undefined)
                {
                  $( '#apellidodiv' ).addClass("has-danger");
                  $('#apellidofeed').text(errors.apellido);
                }else{
                  $( '#apellidodiv' ).removeClass("has-danger");
                  $( '#apellidofeed' ).text("");
                  }

                if(errors.email!=undefined)
                {
                  $( '#emaildiv' ).addClass("has-danger");
                  $('#emailfeed').text(errors.email);
                }else{
                  $( '#emaildiv' ).removeClass("has-danger");
                  $( '#emailfeed' ).text("");
                  }

                if(errors.dui!=undefined)
                {
                 $( '#duidiv' ).addClass("has-danger");
                 $('#duifeed').text(errors.dui);
                }else{
                  $( '#duidiv' ).removeClass("has-danger");
                  $( '#duifeed' ).text("");
                  }

                if(errors.direccion!=undefined)
                {
                  $( '#direcciondiv' ).addClass("has-danger");
                  $('#direccionfeed').text(errors.direccion);
                }else{
                  $( '#direcciondiv' ).removeClass("has-danger");
                  $( '#direccionfeed' ).text("");
                  }

                if(errors.telefono!=undefined)
                {        
                  $( '#telefonodiv' ).addClass("has-danger");
                  $('#telefonofeed').text(errors.telefono);
                }else{
                  $( '#telefonodiv' ).removeClass("has-danger");
                  $( '#telefonofeed' ).text("");
                  }

               if(errors.apodo!=undefined)
                {        
                  $( '#apododiv' ).addClass("has-danger");
                  $('#apodofeed').text(errors.apodo);
                }else{
                  $( '#apododiv' ).removeClass("has-danger");
                  $( '#apodofeed' ).text("");
                  }
                
            }
        });
    });