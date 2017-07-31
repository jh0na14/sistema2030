
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
   //$(".beneid").chosen({width: "95%"});
    $(".beneid2").select2({
      tags: "true",
  placeholder: "Select an option",
  allowClear: true,width: "100%"});
    $("#bene_id").select2({
      tags: "true",
  placeholder: "Select an option",
  width: "100%"});
    
    //$(".js-example-data-array").select2();
//$("#.beneid").append("<option value='otro' selected>otro</option>");
//$('#.beneid').trigger('change'); 
   }); 

/*$(document).on('keyup', '.beneid', function (e) {
      $(".beneid").select2({width: "100%"});
     // $(".beneid").select2({width: "100%"});
      



});  */
$(document).on('click','.darBaja',function(e){
   var value = $(this).val();
  //Otra forma de realizar el get ajax 
  //token siempre para ingresar y modificar 
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();     
    $.ajax({
            type: "PUT",
            url: '/peticiones/darBaja/'+value,
            data: {'id':value},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#msjshow").show();
                $("#msjshow").html(" Registro <strong> Sin Finalizar</strong> ");
    
                 $("#trow" + value).remove();
                 //$("#count2").val()+1;
                  setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/socios');
                }, 4000);
            },
            error: function (data) {
                console.log('Error al dar Baja:', data);
            }
       }); 
    
});

$("#btnsave2").click(function (e) {
    //$("#tabla").append('<tr id="task"><td>"'+document.getElementById("messageform").value+'"</td><td>');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
          soli_id:$('#soli_id').val(),
          titulo:$('#titulo').val(),
          descripcion:$('#descripcion').val(),
          bene_id:$('#bene_id').val(),
           }       

        var type = "POST"; //for creating new resource
        var my_url = "/solicitantes/createPeticion";
        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);
              $('#Modal3').modal('hide');
              $("#msjshow").show();
              $("#msjshow").html(" <strong>Bien hecho!</strong> Peticion guardada exitosamente");
              setTimeout(function(){
                  $("#msjshow").hide();
                $(location).attr('href','/peticiones');
              }, 4000);


           
            },
            error: function (data) {
                console.log('Error de peticion:', data);
               var errors=data.responseJSON;
                console.log(errors);
                if(errors.titulo!=undefined)
                {
                  $('#titulofeed').text(errors.titulo);
                  //$( '#nombrediv' ).removeClass();
                  $( '#titulodiv' ).addClass("has-danger");
                }else{
                  $( '#titulodiv' ).removeClass("has-danger");
                  $( '#titulofeed' ).text("");
                  }
                  
                if(errors.descripcion!=undefined)
                {
                  $( '#descripciondiv' ).addClass("has-danger");
                  $('#descripcionfeed').text(errors.descripcion);
                }else{
                  $( '#descripciondiv' ).removeClass("has-danger");
                  $( '#descripcionfeed' ).text("");
                  }
                
            }
        });
    });

$(document).on('click','.peticionModal',function(){
 var value = $(this).val();
  var output = "";
   //Otra forma de realizar el get ajax el mismo de infomodal    
    $.getJSON('/solicitantes/bus/beneficiarios', function (data) {
          //success data
            console.log(data);     
            for (var i = 0; i < data.length; i++) {
         //     $.each(data[i], function(key, val) {
            //$("#tabla").append('<tr id="task"><td>"'+data[i].nombre+'"</td><td>"'+data[i].ide+'"</td></tr>');
            $("#bene_id").append('<option value="' + data[i].id + '">' + data[i].nombre + ' ' + data[i].apellido + '</option>');
         //   output += '<option value="' + data[i].ide + '">' + data[i].nombre + '</option>';
       // });
            };      
           });
   //$("#bene_id").html(output);
   $("#soli_id").val(value);
   
   $('#Modal3').modal('show'); 
    });

////////////////Esto para busqueda de search
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/peticiones/busqueda/'+value,
            data: {'search':value},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                 $("#tabla").html(data);            
            
            },
            error: function (data) {
                console.log('Error de busqueda search:', data);
            }
       });
 });
///////////////////fin busqueda
 $("#btnnuevo").click(function(){

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Solicitante");
  $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

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
            url: '/peticiones/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
         for (var i = 0; i < data.length; i++) {
                 var row = '<tr><td width="25%"> Peticion #: </td><td width="55%">' + data[i].id + '</td>';
                 row +='<tr><td> Titulo: </td><td>' + data[i].titulo + '</td>';
                 row +='<tr><td> Descripcion: </td><td>' + data[i].descripcion + '</td>';
                 row +='<tr><td> Solicitante: </td><td>' + data[i].nombre +' '+ data[i].apellido + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data[i].dui + '</td>';
                 row +='<tr><td> Beneficiario: </td><td>' + data[i].nombreBen +' '+ data[i].apellidoBen + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data[i].duiBen + '</td>';
                row +='<tr><td> Estado: </td><td>' + data[i].estado + '</td>';
                 row +='<tr><td> Creado en: </td><td>' + data[i].created_at + '</td>';
            
            };  
                /*var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.nombre + '</td>';
                 row +='<tr><td> Apellido: </td><td>' + data.apellido + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data.dui + '</td>';
                 row +='<tr><td> Telefono: </td><td>' + data.telefono + '</td>';
                 row +='<tr><td> Creado en: </td><td>' + data.created_at + '</td>';*/
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
    $.get('/solicitantes/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
          $('#apellido').val(data.apellido);
          $('#dui').val(data.dui);
          $('#telefono').val(data.telefono);
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
     $("#exampleModalLabel").html("Modificar Solicitante");
      
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
          telefono:$('#telefono').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/solicitantes/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/solicitantes/update/'+form_id;
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
                 row +='<td>' + data.telefono + '</td>';       
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

                if(errors.telefono!=undefined)
                {
                  $( '#telefonodiv' ).addClass("has-danger");
                  $('#telefonofeed').text(errors.telefono);
                }else{
                  $( '#telefonodiv' ).removeClass("has-danger");
                  $( '#telefonofeed' ).text("");
                  }
                
            }
        });
    });