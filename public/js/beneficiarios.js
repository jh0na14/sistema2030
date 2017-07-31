
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
  
   });   
////////////////Esto para busqueda
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/beneficiarios/busqueda/'+value,
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
  $("#exampleModalLabel").html("Registro Beneficiario");
  //$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

///////////editodal el boton es la clase infomodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
$(document).on('click','.infomodal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
      //$("#tabla").append('<tr id="task"><td>info</td><td>');
       var form_id = $(this).val();
       
        $("#tablainfo").empty();
        $.ajax({

            type: "GET",
            url: '/beneficiarios/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.nombre + '</td>';
                 row +='<tr><td> Apellido: </td><td>' + data.apellido + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data.dui + '</td>';
                 row +='<tr><td> Fecha de Nacimiento: </td><td>' + data.fechaNac + '</td>';
                 row +='<tr><td> Direccion: </td><td>' + data.descripcion + '</td>';
                 row +='<tr><td> Creado: </td><td>' + data.created_at + '</td>';
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
 //$(".editModal").click(function(){
  var form_id = $(this).val();
    $("#form_id").val(form_id);
    
    //Otra forma de realizar el get ajax el mismo de infomodal    
    $.get('/beneficiarios/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
          $('#apellido').val(data.apellido);
          $('#dui').val(data.dui);
          $('#fechaNac').val(data.fechaNac);
          $('#descripcion').val(data.descripcion);
           });
    //El boton para saber cambair de estado para guardar o modificar 
    $("#btnsave").val("update");
    //$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#form_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar Beneficiario");
      
    });
$("#btnsavee").click(function (e) {
  $('#frm').submit();
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
          dui:$('#dui').val(),
          fechaNac:$('#fechaNac').val(),
          descripcion:$('#descripcion').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/beneficiarios/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/beneficiarios/update/'+form_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);
               $('#exampleModal').modal('hide');
              $("#msjshow").show();
              if(state=="add"){
               $("#msjshow").html(" <strong>Bien hecho!</strong> Registro guardado exitosamente (recargar pagina para ver cambios)");
               }else{
               $("#msjshow").html(" <strong>Bien hecho!</strong> Registro editado exitosamente (recargar pagina para ver cambios)");  
               }

                //redirect('/socios');
            if(state=="add"){
                var row = '<tr><td>' + data.nombre + '</td>';
                 row +='<td>' + data.apellido + '</td>';
                 row +='<td>' + data.dui + '</td>';
                 row +='<td>' + data.fechaNac + '</td>';       
                 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
                 row += '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'+data.id+'">Editar</button> ';
                 row +='<button type="button" class="btn btn-outline-danger btn-sm" value="'+data.id+'">Eliminar</button>';
                 row +='</td></tr>';
                //var task='<tr id="task"><td>rregre</td><td>';
                 $("#tabla").append(row);
               }
               setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/socios');
                }, 4000);

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

                if(errors.dui!=undefined)
                {
                 $( '#duidiv' ).addClass("has-danger");
                 $('#duifeed').text(errors.dui);
                }else{
                  $( '#duidiv' ).removeClass("has-danger");
                  $( '#duifeed' ).text("");
                  }

                if(errors.descripcion!=undefined)
                {
                  $( '#descripciondiv' ).addClass("has-danger");
                  $('#descripcionfeed').text(errors.direccion);
                }else{
                  $( '#descripciondiv' ).removeClass("has-danger");
                  $( '#descripcionfeed' ).text("");
                  }
                
            }
        });
    });