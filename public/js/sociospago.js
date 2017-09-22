////////////////Esto para busqueda en sociospago pantalla
 $("#search2").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/sociospago/busqueda/'+value,
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

$(document).on('click','.infomodal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
       var socio_id = $(this).val();
       //$('#nombrediv').text("ldjkds");
         //$('#apellidodiv').text("dckjdsjknds");   

        $("#tablainfo").empty();
        $.ajax({

            type: "GET",
            url: '/socios/buscar/'+socio_id,
            data: socio_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td width="45%"> Nombre: </td><td width="55%">' + data.nombre + '</td>';
                 row +='<tr><td> Apellido: </td><td>' + data.apellido + '</td>';
         row +='<tr><td> Apodo: </td><td>' + data.apodo + '</td>';
         row +='<tr><td> Fecha de Nacimiento: </td><td>' + data.fechaNac + '</td>';
           row +='<tr><td> DUI: </td><td>' + data.dui + '</td>';
         row +='<tr><td> Direccion: </td><td>' + data.direccion + '</td>';
         row +='<tr><td> Telefono: </td><td>' + data.telefono + '</td>';
         row +='<tr><td> Email: </td><td>' + data.email + '</td>';
         row +='<tr><td> Tipo de Socio: </td><td>' + data.tipoSocio + '</td>';
         row +='<tr><td> Cargo: </td><td>' + data.cargo + '</td>';
         row +='<tr><td> Estado: </td><td>' + data.estado + '</td>';
         
                  $("#tablainfo").append(row);            
            
            },
            error: function (data) {
                console.log('Error de info boton:', data);
            }
       });
   $('#myModal').modal('show'); 
    });

$(document).on('click','.pagosAccion',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".pagosAccion").click(function(){
       var val = $(this).val();     
     $(location).attr('href','/pagos/'+val);
     
    });