
$(document).ready(function(){
 
   }); 
//del modal del motivo de eliminacion
$("#btnsave3").click(function (e) {
   //es ell id de peticion pude tambien elegido peticion_id de variable
   var value = $('#delete_id').val();
  //Otra forma de realizar el get ajax 
  //token siempre para ingresar y modificar 
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
          motivoCancelacion:$('#motivo').val(),
          // delete_id:$('#delete_id').val(),
           }   

        console.log(formData);    
    
    $.ajax({
            type: "PUT",
            url: '/peticiones/darBaja/'+value,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#Modal4').modal('hide'); 
                $("#msjshow").show();
                $("#msjshow").html(" Registro <strong> Cancelado</strong> ");
    
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

$(document).on('click','.darBaja',function(e){
  var value = $(this).val();
  //es ell id de peticion pude tambien elegido peticion_id de variable
  $('#delete_id').val(value);
  $('#Modal4').modal('show'); 
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
          nombre:$('#nombre').val(),
          fechaInicio:$('#fechaInicio').val(),
          fechaFin:$('#fechaFin').val(),
          presupuesto:$('#presupuesto').val(),
          peticion_id:$('#peticion_id').val(),
           }       

        var type = "POST"; //for creating new resource
        var my_url = "/peticiones/createProyecto";
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
              $("#msjshow").html(" <strong>Bien hecho!</strong> Proyecto guardado exitosamente");
              setTimeout(function(){
                  $("#msjshow").hide();
                $(location).attr('href','/peticiones');
              }, 4000);


           
            },
            error: function (data) {
                console.log('Error de peticion:', data);
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
                  
                if(errors.fechaInicio!=undefined)
                {
                  $( '#fechaIniciodiv' ).addClass("has-danger");
                  $('#fechaIniciofeed').text(errors.fechaInicio);
                }else{
                  $( '#fechaIniciodiv' ).removeClass("has-danger");
                  $( '#fechaIniciofeed' ).text("");
                  }

                if(errors.fechaFin!=undefined)
                {
                  $( '#fechaFindiv' ).addClass("has-danger");
                  $('#fechaFinfeed').text(errors.fechaFin);
                }else{
                  $( '#fechaFindiv' ).removeClass("has-danger");
                  $( '#fechaFinfeed' ).text("");
                  }

                if(errors.presupuesto!=undefined)
                {
                  $( '#presupuestodiv' ).addClass("has-danger");
                  $('#presupuestofeed').text(errors.presupuesto);
                }else{
                  $( '#presupuestodiv' ).removeClass("has-danger");
                  $( '#presupuestofeed' ).text("");
                  }
                  
            }
        });
    });

$(document).on('click','.proyectoModal',function(){
 var value = $(this).val();
  var output = "";
   $("#peticion_id").val(value);
    //Otra forma de realizar el get ajax el mismo de infomodal    
    $.get('/peticiones/buscar1/' + value, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.titulo);
           });
   
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
                 row +='<tr><td> Fecha creacion: </td><td>' + data[i].created_at + '</td>';
                 if(data[i].motivoCancelacion!=null)
                  row +='<tr><td> Motivo de Cancelacion: </td><td>' + data[i].motivoCancelacion + '</td>';
                 
                 //row +='<tr><td> Periodo: </td><td>' + data[i].semestre + '</td>';
                  
            
            };  
                   $("#tablainfo").append(row);            
            
            },
            error: function (data) {
                console.log('Error de info boton:', data);
            }
       });
   $('#myModal').modal('show'); 
    });

///////////esto no o lleva peticiones pero estoy pensando en ponerlo para 
$(document).on('click','.editModal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick 
 //$(".editModal").click(function(){
  $("#noMostrar").hide();

  var peticion_id = $(this).val();
    $("#peticion_id").val(peticion_id);
    
    //Otra forma de realizar el get ajax el mismo de infomodal    
    $.get('/peticiones/buscar1/' + peticion_id, function (data) {
          //success data
            console.log(data);
            $('#titulo').val(data.titulo);
          $('#descripcion').val(data.descripcion);
           });
    //El boton para saber cambair de estado para guardar o modificar 
    $("#btnsave").val("update");

    $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#peticion_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar Peticion");
      
    });

$("#btnsavee").click(function (e) {
  $('#frm').submit();
});

//////en esta peticion solo modifica no hay pantallas de insercion solo de proyecto que esta arriba
//////en btnsave2
  $("#btnsave").click(function (e) {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
          //nombre:document.getElementById("nombre").value,
          titulo:$('#titulo').val(),
          descripcion:$('#descripcion').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "PUT"; //for creating new resource
        var peticion_id = $('#peticion_id').val();;
        var my_url = "/peticiones/update/"+peticion_id;

       /*if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/peticiones/update/'+peticion_id;
        }*/

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
              
               $("#msjshow").html(" <strong>Bien hecho!</strong> Registro tiulo "+data+" editado exitosamente");  
               

               
                setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/peticiones');
                window.location.reload();
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