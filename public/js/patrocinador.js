
$(document).ready(function(){
  $("#tabla").append('<tr id="task"><td>rregre</td><td>');
  //$("#fechaNac").mask('xxxx-xxxx');
  
   });   

 $("#btnnuevo").click(function(){

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Patrocinador");
  $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

///////////editodal el boton es la clase infomodal por que id en el boton no agarraba por que repetia
///////////en el listado d la tabla
 $(".infomodal").click(function(){
      $("#tabla").append('<tr id="task"><td>info</td><td>');
       var form_id = $(this).val();
       
        $("#tablainfo").empty();
        $.ajax({

            type: "GET",
            url: '/patrocinador/buscar/'+form_id,
            data: form_id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
        
                var row = '<tr><td> Nombre: </td><td>' + data.nombre + '</td>';
                 row +='<tr><td> Descripcion: </td><td>' + data.descripcion + '</td>';
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
 $(".editModal").click(function(){
  var form_id = $(this).val();
    $("#form_id").val(form_id);
    
    //Otra forma de realizar el get ajax el mismo de infomodal    
    $.get('/patrocinador/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
          $('#descripcion').val(data.descripcion);
           });
    //El boton para saber cambair de estado para guardar o modificar 
    $("#btnsave").val("update")
    $("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#form_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar patrocinador");
      
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
          descripcion:$('#descripcion').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();;
        var my_url = "/patrocinador/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/patrocinador/update/'+form_id;
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
                var row = '<tr><td>' + data.nombre + '</td>';
                 row +='<td>' + data.descripcion + '</td>';       
                 row += '<td class="text-center"><button type="button" class="btn btn-outline-info btn-sm infomodal" value="'+data.id+'">Info</button>  ';
                 row += '<button type="button" class="btn btn-outline-success btn-sm " data-toggle="modal" data-target="#exampleModal" value="'+data.id+'">Editar</button>  ';
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
                if(errors.nombre!=undefined)
                {
                  $('#nombrefeed').text(errors.nombre);
                  //$( '#nombrediv' ).removeClass();
                  $( '#nombrediv' ).addClass("has-danger");
                }else{
                  $( '#nombrediv' ).removeClass("has-danger");
                  $( '#nombrefeed' ).text("");
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