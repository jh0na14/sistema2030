////////////////Esto para busqueda en sociospago pantalla
 $("#search2").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/controlSocios/busqueda/'+value,
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
