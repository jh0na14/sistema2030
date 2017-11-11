
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
  
   });   
////////////////Esto para busqueda
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/patrocinador/busqueda/'+value,
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
  $("#exampleModalLabel").html("Registro Patrocinador");
  $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();

 });
$(document).on('click','.btndona',function(){
   var value = $(this).val();
  $("#proyecto_id").val(value);
 
 $('#btnsaveDona').val("add");
  $("#btnsaveDona").html("Nuevo");
  $("#btnsaveDona").removeClass("btn-success");
  $("#exampleModalLabel1").html("Registro Patrocinador");
  $("#tabla").append('<tr id="task"><td>kjhkj</td><td>');
    //$('#frm').trigger('reset');

   $('#ModalDona').modal('show'); 

   $('#noMostrar').hide(); 
    //$('#frmsocios')[0].reset();

 });
//////////guardar modal donaciones dentro de patrocinador 
  $("#btnsaveDona").click(function (e) {
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
          idpatrocinadors:$('#proyecto_id').val(),
          monto:$('#monto').val(),
          descripcion:$('#descripcion').val(),
          fecha:$('#fecha').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsaveDona').val();
        var type = "POST"; //for creating new resource
        //var form_id = $('#form_id').val();;
        var my_url = "/patrocinador/createDonacion";

       //if (state == "update"){
         //   type = "PUT"; //for updating existing resource
           // my_url = '/patrocinador/update/'+form_id;
        //}

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);
               $('#ModalDona').modal('hide'); 
               $("#msjshow").show();
              
               $("#msjshow").html(" <strong>Bien hecho!</strong>Donacion recibida exitosamente");  
                          
                setTimeout(function(){
                  $("#msjshow").hide();
                $(location).attr('href','/donaciones/Recibidas');
               // window.location.reload();
                }, 4000);
                //redirect('/socios');
            /*if(state=="add"){
                var row = '<tr><td>' + data.id + '</td>';
                row = '<tr><td>' + data.monto + '</td>';
                 row +='<td>' + data.descripcion + '</td>';
                 row = '<tr><td>' + data.fecha + '</td>';
                 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
                 row += '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'+data.id+'">Editar</button> ';
                 row +='<button type="button" class="btn btn-outline-danger btn-sm" value="'+data.id+'">Eliminar</button>';
                 row +='</td></tr>';
                //var task='<tr id="task"><td>rregre</td><td>';
                 $("#tabla").append(row);
               }
                *//*if (state == "add"){ //if user added a new record
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
                if(errors.monto!=undefined)
                {
                  $('#montofeed').text(errors.monto);
                  //$( '#montodiv' ).removeClass();
                  $( '#montodiv' ).addClass("has-danger");
                }else{
                  $( '#montodiv' ).removeClass("has-danger");
                  $( '#montofeed' ).text("");
                  }
                  
                if(errors.descripcion!=undefined)
                {
                  $( '#descripciondiv' ).addClass("has-danger");
                  $('#descripcionfeed').text(errors.descripcion);
                }else{
                  $( '#descripciondiv' ).removeClass("has-danger");
                  $( '#descripcionfeed' ).text("");
                  }
                  if(errors.fecha!=undefined)
                {
                  $( '#fechadiv' ).addClass("has-danger");
                  $('#fechafeed').text(errors.fecha);
                }else{
                  $( '#fechadiv' ).removeClass("has-danger");
                  $( '#fechafeed' ).text("");
                  }
                
            }
        });
    });
///////final guardar donacion dentro de patrocinador///////
/////////////////////////////////////////////////////////////////

///////////editodal el boton es la clase infomodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
$(document).on('click','.infomodal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
      $("#tabla").append('<tr id="task"><td>info</td><td>');
       var form_id = $(this).val();
       
        $("#tablainfo").empty();
        $.ajax({

            type: "GET",
            url: '/patrocinador/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.nombre + '</td>';
                row +='<tr><td> Apellido: </td><td>' + data.descripcion + '</td>';
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
    $.get('/patrocinador/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
          $('#descripcionPatro').val(data.descripcion);
           });
    //El boton para saber cambair de estado para guardar o modificar 
    $("#btnsave").val("update");
    $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#form_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar Patrocinador");
      
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
          descripcion:$('#descripcionPatro').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();
        var my_url = "/patrocinador/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/patrocinador/update/'+form_id;
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
                //redirect('/socios');
            if(state=="add"){
                var row = '<tr><td>' + data.nombre + '</td>';
                 row +='<td>' + data.descripcion + '</td>';
                 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
                 row += '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'+data.id+'">Editar</button> ';
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
                  
                if(errors.descripcion!=undefined)
                {
                  $( '#descripcionPatrodiv' ).addClass("has-danger");
                  $('#descripcionPatrofeed').text(errors.descripcion);
                }else{
                  $( '#descripcionPatrodiv' ).removeClass("has-danger");
                  $( '#descripcionPatrofeed' ).text("");
                  }
                
            }
        });
    });