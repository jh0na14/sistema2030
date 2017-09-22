$(document).ready(function(){
 
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
