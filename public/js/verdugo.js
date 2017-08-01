
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
     //para select con relacion 
      $("#socioid2").select2({
      tags: "true",
  placeholder: "Select an option",
  allowClear: true,width: "100%"});
    $(".socioid").select2({
      tags: "true",
  placeholder: "Select an option",
  width: "100%"});
   });   



////////////////Esto para busqueda
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/verdugo/busqueda/'+value,
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
  var output = "";
   //Otra forma de realizar el get ajax el mismo de infomodal    
    $.getJSON('/verdugo/bus/socios', function (data) {
          //success data
            console.log(data);
             
            for (var i = 0; i < data.length; i++) {
         //     $.each(data[i], function(key, val) {
            //$("#tabla").append('<tr id="task"><td>"'+data[i].nombre+'"</td><td>"'+data[i].ide+'"</td></tr>');
            $("#socioid2").append('<option value="' + data[i].id + '">' + data[i].nombre + ' ' + data[i].apellido + '</option>');
            output += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
       // });
            };
        
                    
           });

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Verdugo");
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
            url: '/verdugo/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.fechaPago + '</td>';
                row +='<tr><td> Monto Recaudado: </td><td>' + data.montoRecaudado + '</td>';                                row +='<tr><td> Apellido: </td><td>' + data.montoRecaudado + '</td>';
                row +='<tr><td> Monto Rifa: </td><td>' + data.montoRifa + '</td>';

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
    $.get('/verdugo/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#fechaPago').val(data.fechaPago);
          $('#montoRecaudado').val(data.montoRecaudado);
          $('#montoRifa').val(data.montoRifa); 
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
     $("#exampleModalLabel").html("Modificar Verdugo");
      
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
          
          fechaPago:$('#fechaPago').val(),
          montoRecaudado:$('#montoRecaudado').val(),
          montoRifa:$('#montoRifa').val(),
          idsocios:$('#socioid2').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/verdugo/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/verdugo/update/'+form_id;
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
                var row = '<tr><td>' + data.fechaPago + '</td>';
                 row +='<td>' + data.montoRecaudado + '</td>';
                 row +='<td>' + data.montoRifa + '</td>';
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
                if(errors.fechaPago!=undefined)
                {
                  $('#fechaPagofeed').text(errors.fechaPago);
                  //$( '#fechaPagodiv' ).removeClass();
                  $( '#fechaPagodiv' ).addClass("has-danger");
                }else{
                  $( '#fechaPagodiv' ).removeClass("has-danger");
                  $( '#fechaPagofeed' ).text("");
                  }
                  
                if(errors.montoRecaudado!=undefined)
                {
                  $( '#montoRecaudadodiv' ).addClass("has-danger");
                  $('#montoRecaudadofeed').text(errors.montoRecaudado);
                }else{
                  $( '#montoRecaudadodiv' ).removeClass("has-danger");
                  $( '#montoRecaudadofeed' ).text("");
                  }

                  if(errors.montoRifa!=undefined)
                {
                  $( '#montoRifadiv' ).addClass("has-danger");
                  $('#montoRifafeed').text(errors.montoRifa);
                }else{
                  $( '#montoRifadiv' ).removeClass("has-danger");
                  $( '#montoRifafeed' ).text("");
                  }
                
            }
        });
    });