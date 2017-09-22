$(document).ready(function(){
 
   }); 
$(document).on('click','.donacionModal',function(e){
  var value = $(this).val();
   $('#exampleModal').modal('show'); 
   $("#proyecto_id").val(value);
});
$(document).on('click','.infomodal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
       var form_id = $(this).val();
       $("#myModalLabel").html('Datos de Personales');
        $("#tablainfo").empty();
        $.ajax({

            type: "GET",
            url: '/peticiones/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {

                console.log(data);
         for (var i = 0; i < data.length; i++) {
                // var row = '<tr><td width="25%"> Peticion #: </td><td width="55%">' + data[i].id + '</td>';
                 var row ='<tr><td> Titulo: </td><td>' + data[i].titulo + '</td>';
                 row +='<tr><td> Descripcion: </td><td>' + data[i].descripcion + '</td>';
                 row +='<tr><td> Solicitante: </td><td>' + data[i].nombre +' '+ data[i].apellido + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data[i].dui + '</td>';
                 row +='<tr><td> Beneficiario: </td><td>' + data[i].nombreBen +' '+ data[i].apellidoBen + '</td>';
                 row +='<tr><td> DUI: </td><td>' + data[i].duiBen + '</td>';
                //row +='<tr><td> Estado: </td><td>' + data[i].estado + '</td>';
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

 $("#btnsave").click(function (e) {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
          proyecto_id:$('#proyecto_id').val(),
          monto:$('#monto').val(),
          descripcion:$('#descripcion').val(),
          fecha:$('#fecha').val(),
          categoria:$('#categoria').val(),
          
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var peticion_id = $('#peticion_id').val();;
        var my_url = "/proyectos/createDonacion";

       /*if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/proyectos/update/'+proyecto_id;
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
              
               $("#msjshow").html(" <strong>Bien hecho!</strong> Proyecto de donacion realizado exitosamente");  
                          
                setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/peticiones');
                window.location.reload();
                }, 4000);
            },
            error: function (data) {
                console.log('Error de noseq:', data);
               var errors=data.responseJSON;
                console.log(errors);
               if(errors.monto!=undefined)
                {
                  $('#montofeed').text(errors.monto);
                  //$( '#nombrediv' ).removeClass();
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
                
                
            }
        });
    });