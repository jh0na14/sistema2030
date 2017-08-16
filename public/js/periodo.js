
$(document).ready(function(){
  //$("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
    $("#socio1").select2({
      tags: "true",
  placeholder: "Seleccione un socio",
  width: "100%"});
  $("#socio2").select2({
      tags: "true",
  placeholder: "Seleccione un socio",
  width: "100%"});
  $("#socio3").select2({
      tags: "true",
  placeholder: "Seleccione un socio",
  width: "100%"});
  
  }); 

////////////////Esto para busqueda de search
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/periodos/busqueda/'+value,
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
  var output = "";
   //Otra forma de realizar el get ajax el mismo de infomodal    
    $.getJSON('/periodos/bus/socios', function (data) {
          //success data
            console.log(data);     
            for (var i = 0; i < data.length; i++) {
         //     $.each(data[i], function(key, val) {
            //$("#tabla").append('<tr id="task"><td>"'+data[i].nombre+'"</td><td>"'+data[i].ide+'"</td></tr>');
            $("#socio1").append('<option value="' + data[i].id + '">' + data[i].nombre + ' ' + data[i].apellido + '</option>');
            $("#socio2").append('<option value="' + data[i].id + '">' + data[i].nombre + ' ' + data[i].apellido + '</option>');
            $("#socio3").append('<option value="' + data[i].id + '">' + data[i].nombre + ' ' + data[i].apellido + '</option>');
         //   output += '<option value="' + data[i].ide + '">' + data[i].nombre + '</option>';
       // });
            };      
           });
   //$("#bene_id").html(output);
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
            url: '/periodos/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Fecha Inicio: </td><td width="55%">' + data.fechaInicio + '</td>';
                 row +='<tr><td> Fecha Fin: </td><td>' + data.fechaFin + '</td>';
                 row +='<tr><td> estado: </td><td>' + data.estado + '</td>';
                row +='<tr><td> Creado en: </td><td>' + data.created_at + '</td>';
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
    $.get('/periodos/buscar/' + form_id, function (data) {
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
          fechaInicio:$('#fechaInicio').val(),
          fechaFin:$('#fechaFin').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/periodos/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/periodos/update/'+form_id;
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
                var row = '<tr><td>' + data.id + '</td>';
                 //row +='<td>' + data.id + '</td>';       
                 row +='<td>' + data.fechaInicio + '</td>';
                 row +='<td>' + data.fechaFin + '</td>';
                 row +='<td>' + data.estado + '</td>';
                 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
                 row += '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'+data.id+'">Editar</button> ';
                 row +='<button type="button" class="btn btn-outline-danger btn-sm" value="'+data.id+'">Activar</button>';
                 row +='</td></tr>';
                //var task='<tr id="task"><td>rregre</td><td>';
                 $("#tabla").append(row);
               }

                setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/socios');
                }, 4000);

                
            },
            error: function (data) {
                console.log('Error de noseq:', data);
               var errors=data.responseJSON;
                console.log(errors);
                if(errors.fechaInicio!=undefined)
                {
                  $('#fechaIniciofeed').text(errors.fechaInicio);
                  //$( '#nombrediv' ).removeClass();
                  $( '#fechaIniciodiv' ).addClass("has-danger");
                }else{
                  $( '#fechaIniciodiv' ).removeClass("has-danger");
                  $( '#fechaIniciofeed' ).text("");
                  }
                  
                  if(errors.fechaFin!=undefined)
                {
                  $('#fechaFinfeed').text(errors.fechaFin);
                  //$( '#nombrediv' ).removeClass();
                  $( '#fechaFindiv' ).addClass("has-danger");
                }else{
                  $( '#fechaFindiv' ).removeClass("has-danger");
                  $( '#fechaFinfeed' ).text("");
                  }
                
                
            }
        });
    });