
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
            url: '/pagoasoc/busqueda/'+value,
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
    $.getJSON('/pagoasoc', function (data) {
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
  $("#exampleModalLabel").html("Registro Pago Asociacion");
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
            url: '/pagoasoc/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Monto: </td><td width="55%">' + data.monto + '</td>';
                row +='<tr><td> Fecha: </td><td>' + data.fecha + '</td>';                                row +='<tr><td> Apellido: </td><td>' + data.montoRecaudado + '</td>';
                row +='<tr><td> idPeriodo: </td><td>' + data.idPeriodo + '</td>';

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
    $.get('/pagoasoc/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#monto').val(data.monto);
          $('#fecha').val(data.fecha);
          $('#idPeriodo').val(data.idPeriodo); 
           
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
     $("#exampleModalLabel").html("Modificar Pagos Asociacion");
      
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
          
          monto:$('#monto').val(),
          //fecha:$('#fecha').val(),
          idPeriodo:$('#idPeriodo').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/pagoasoc/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/pagoasoc/update/'+form_id;
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
                var row = '<tr><td>' + data.monto + '</td>';
                 row +='<td>' + data.fecha + '</td>';
                 row +='<td>' + data.idPeriodo + '</td>';
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
                if(errors.monto!=undefined)
                {
                  $('#montofeed').text(errors.monto);
                  //$( '#fechaPagodiv' ).removeClass();
                  $( '#montodiv' ).addClass("has-danger");
                }else{
                  $( '#montodiv' ).removeClass("has-danger");
                  $( '#montofeed' ).text("");
                  }
                  
                if(errors.fecha!=undefined)
                {
                  $( '#fechadiv' ).addClass("has-danger");
                  $('#fechafeed').text(errors.fecha);
                }else{
                  $( '#fechadiv' ).removeClass("has-danger");
                  $( '#fechafeed' ).text("");
                  }

                  if(errors.idPeriodo!=undefined)
                {
                  $( '#idPeriododiv' ).addClass("has-danger");
                  $('#idPeriodofeed').text(errors.idPeriodo);
                }else{
                  $( '#idPeriododiv' ).removeClass("has-danger");
                  $( '#idPeriodofeed' ).text("");
                  }
                
            }
        });
    });