$(document).ready(function(){
 
   }); 
$(document).on('click','.pagoAccion',function(e){
  var value = $(this).val();
   $('#exampleModal').modal('show'); 
   $("#idvar").val(value);
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
    var value = $("#idvar").val();
    var bandera="";
    var idsocios=0;
  //Otra forma de realizar el get ajax 
  //token siempre para ingresar y modificar 
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();   
        console.log(value);  
    $.ajax({
            type: "PUT",
            url: '/pagos/pagar/'+value,
            data: {'id':value},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#exampleModal').modal('hide');
                $("#msjshow").show();
                var row ="";
                 for (var i = 0; i < data.length; i++) {
                   $("#msjshow").html(" <strong>Pago de mes de " + data[i].mes + " realizado exitosamente!</strong>");
                
                 row +='<tr><td style="font-size:14px">Cúota ' + data[i].numMes + ', mes ' + data[i].mes + '</td>';
                  row +='<td class="text-center">' + data[i].monto + '</td>';
                  row +='<td class="text-center">  ' + data[i].año + '</td>';
                   row +='<td class="text-center">' + data[i].fechaPago + '</td>';
                  row +='<td class="text-center @if($pago->estado=="CANCELADO") text-secondary @else text-danger @endif "  style="font-size:13px">' + data[i].estado + '</td>';
                  row +='<td class="text-center"><button style="font-size:12px" type="button" class="btn btn-outline-secondary btn-sm infomodal" value="' + data[i].id + '">Hacer Pago</button></td>';
                  
                  $("#trow" + value).replaceWith( row );
                  row="";
                  //$("#idvar").val(data[i].idsocios);
                   idsocios=data[i].idsocios;
                   $.ajax({
                    type: "PUT",
                    url: '/pagos/deudaActual/'+data[i].idsocios,
                    data: data[i].idsocios,
                    dataType: 'json',
                    success: function (data) {
                    console.log(data);

                      $("#deudaTotal").html('DEUDA: '+data);
                    //setTimeout(function(){
                     // $("#msjshow").hide();
                    //$(location).attr('href','/socios');
                    //}, 3000);              
            },
            error: function (data) {
                console.log('Error de show datos <td>', data);
            }
       });//fin ajax


          var formData = {
          fecha:data[i].fechaPago,
          concepto:'pago '+ data[i].numMes +' '+ data[i].mes +' año '+data[i].año,
          ingreso:data[i].monto,
           } 
           console.log(formData);
                   $.ajax({
                    type: "POST",
                    url: '/pagos/createTMembresia',
                    data: formData,
                    dataType: 'json',
                    success: function (data1) {
                    console.log(data1);

                     // $("#deudaTotal").html('DEUDA: '+data);
                    setTimeout(function(){
                      $("#msjshow").hide();
                    //$(location).attr('href','/socios');
                    }, 3000);              
            },
            error: function (data) {
                console.log('Error de create tMembresia', data);
            }
       });//fin ajax post                 

                   }////fin For

                   //bandera="entrar";

                  
                 
            },
            error: function (data) {
                console.log('Error al dar Baja:', data);
            }
       }); /////fin ajax 1

/*    if (bandera='entrar8') {
      var x=idsocios;//$("#idvar").val();
      console.log(x);
       $.ajax({

            type: "GET",
            url: '/pagos/deudaActual/'+x,
            data: x,
            dataType: 'json',
            success: function (data) {
                console.log(data);

               // $("#deudaTotal").html(data);
                setTimeout(function(){
                  $("#msjshow").hide();
                //$(location).attr('href','/socios');
                }, 3000);


                              
            
            },
            error: function (data) {
                console.log('Error de info boton:', data);
            }
       });

    }////fin if*/

  
   });