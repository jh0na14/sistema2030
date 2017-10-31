
$(document).ready(function(){
  $("#noMostrar").hide();
  //$("#fechaNac").mask('xxxx-xxxx');
  
   });   
////////////////Esto para busqueda
 $("#search").on('keyup',function(){
    var value = $(this).val();
     $.ajax({

            type: "GET",
            url: '/beneficiarios/busqueda/'+value,
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

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Beneficiario");
  //$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    $('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();

 });

$(document).on('click','.puntosModal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick
// $(".infomodal").click(function(){
      //$("#tabla").append('<tr id="task"><td>info</td><td>');
       var form_id = $(this).val();
   $('#etnumAgenda').val(form_id);  
   var numAgenda =$(this).attr('data-numAgenda');          
   $('#divnumAgenda').html("Agenda #"+numAgenda);           
   $('#etPuntos').prop("disabled",false);      
   $('#myModal').modal('show'); 
   $('#btnPuntos').click();
    });

$(document).on('click','.unoAccion',function(){
  var value= $(this).val();
  $('#etPuntos').prop("disabled",false);      
  $('#etPuntos').focus();  
  $('#etPuntos').attr("placeholder","Nombre Punto nivel 1");
  $('#etPuntos').val("");
  $('#unoDos').val(1);
   $('#addPunto').val("add");
   $('#addPunto').html("Añadir");  
  //$('#ids').val(value);
    });

$(document).on('click','.dosAccion',function(){
    var value= $(this).val();
   $('#etPuntos').prop("disabled",false);
   $('#etPuntos').focus();
  $('#etPuntos').val("");
   $('#etPuntos').attr("placeholder","Nombre Punto nivel 2");        
   $('#unoDos').val(2);
  // $('#ids').val(value);
   $('#idpuntos').val(value);
   $('#addPunto').val("add");

   $('#addPunto').html("Añadir");
        
    });

//$(document).on('click','.addPunto',function(){
$("#addPunto").click(function (e) {
  var nivel= $('#unoDos').val();
  $('#etPuntos').prop("disabled",true); 
  
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var state = $(this).val();
        var type = "POST"; //for creating new resource
        //var form_id = $('#form_id').val();
        if(state=="add"){
        if(nivel==1){
          var formData = {
           //nivel:1, 
          idagendas:$('#etnumAgenda').val(),
          nombre:$('#etPuntos').val(),
          nivel:1,
           }
          var my_url = "/agenda/createPunto";

        }else{
          if (nivel==2) {
            var formData = {
            //nivel:2,
            nombre:$('#etPuntos').val(),
            idpuntos:$('#idpuntos').val(),
            nivel:2,
             } 
             var my_url = "/agenda/createSubPunto";
           }
           
        }
      }//fin state add

       if (state == "edit"){
        var formData = {
            nivel:nivel,
            nombre:$('#etPuntos').val(),
            //idpuntos:$('#idpuntos').val(),
            } 
            type = "PUT"; //for updating existing resource
            my_url = '/agenda/updatePuntos/'+$('#ids').val();
        }
        if (state == "delete"){
        var formData = {
            nivel:nivel,
            nombre:$('#etPuntos').val(),
            //idpuntos:$('#idpuntos').val(),
            } 
            type = "PUT"; //for updating existing resource
            my_url = '/agenda/deletePuntos/'+$('#ids').val();
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
              $("#msjshow2").show();
              if(state=="add"){
               $("#msjshow2").html(data+" <strong>Bien hecho!</strong> Punto guardado exitosamente");
               }else if(state=="edit"){
               $("#msjshow2").html(data+" <strong>Bien hecho!</strong> Punto editado exitosamente");  
               }else if(state=="delete"){
               $("#msjshow2").html(data+" <strong>Bien hecho!</strong> Punto borrado exitosamente");  
               }
           
               setTimeout(function(){
                  $("#msjshow2").hide();
                //$(location).attr('href','/agenda');
                }, 4000);

               
            },
            error: function (data) {
                console.log('Error de noseq:', data);
               var errors=data.responseJSON;
                console.log(errors);
                
              
            }
        });
$("#btnPuntos").click();

    });

$("#btnPuntos").click(function(){
  var value=$('#etnumAgenda').val();
  $("#tablaPuntos").empty();
  var row="";
  $.ajax({
        type: "GET",
        url: '/agenda/tablaPuntos/'+value,
        data: value,
        dataType: 'json',
        success: function (data) {
        console.log(data);
        var k=0;
        var l=0;
        for (var i = 0; i < data.length; i++) {
          k++;
          for (var j = 0; j < data[i].length; j++) {
                    
             row +='<tr id="' + data[i][j].id+ '">';
             if(data[i][j].nivel==1){
             row +='<td class="text-center">';
             row +='<button type="button" class="btn btn-outline-primary btn-sm unoAccion" value="' + data[i][j].id + '">1</button> ';
             row +='<button type="button" class="btn btn-outline-info btn-sm dosAccion" value="' + data[i][j].id + '">2</button>';
             row +='</td>';
             row +='<td style="font-weight:bold;">' +k + ' &nbsp&nbsp' + data[i][j].nombre + '</td>';
             row +='<td>';
            
            }
             if(data[i][j].nivel==2){
             row +='<td class="text-center">';
             row +='</td>';
             row +='<td style="font-weight:bold;">&nbsp&nbsp&nbsp' +k + '.' +l + ' &nbsp&nbsp' + data[i][j].nombre + '</td>';
             row +='<td>';
            }
             //row +='</td>';
             //row +='<td style="font-weight:bold;">' + data[i][j].nivel + '</td>';
             ///row +='<td>';
             row +='</button> ';
             // row +='<img class="rounded-circle" src="{{asset(icons/boton-borrar.png)}}" height="10" width="10">';
             row +='<button type="button" class="btn btn-outline-success btn-sm editPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">Editar';
             //row +='<img class="rounded-circle" src="{{asset(icons/boton-arriba.png)}}public/icons/boton-arriba.png" height="10" width="10">';
             row +='</button> ';
             if(data[i][j].descripcion==null){
             row +='<button type="button" class="btn btn-outline-danger btn-sm eliminarPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">x';
             row +='</button> ';
              }else{
              row +='<button type="button" class="btn btn-outline-secondary btn-sm eliminarPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">x';
               }
           // row +='<button type="button" class="btn btn-outline-secondary btn-sm abajo" value=""> ';
           // row +='<img class="rounded-circle" src="{{asset(icons/boton-abajo.png)}}" height="10" width="10">';
            //row +='</button>';
            row +='</td>';
            row +='</tr>';

            
             //if(data[i].motivoCancelacion!=null)
              // row +='<tr><td> Motivo de Cancelacion: </td><td>' + data[i].motivoCancelacion + '</td>' 
            l++;
                 };//fin for 
              //k=0;
              l=0;    
                 };//fin for              
            //row="";
$("#tablaPuntos").append(row);
//or
//$("#tablaPuntos").html(row);



            },//fin ajax 1
        error: function (data) {
            console.log('Error de info boton:', data);
         }
    });
  

 });
$(document).on('click','.eliminarPunto',function(){
   var value = $(this).val(); 
   $('#etPuntos').prop("disabled",true);   
   $('#ids').val(value);   
    $('#addPunto').val("delete");
  var dataparametro =$(this).attr('data-nombre');
   $('#etPuntos').val(dataparametro); 
  var unoDos =$(this).attr('data-unoDos');
   $('#unoDos').val(unoDos);

$("#addPunto").click();
   
    });

///no funciono no se or que
function parametros(x){
  $('#etPuntos').val("nombre");
}

$(document).on('click','.editPunto',function(){
   var value = $(this).val(); 
   $('#etPuntos').prop("disabled",false);
   $('#etPuntos').focus();  
   $('#addPunto').html("Modificar");  
  
   $('#ids').val(value);
   $('#addPunto').val("edit");
//var plant = document.getElementById('strawberry-plant');
var dataparametro =$(this).attr('data-nombre');
   $('#etPuntos').val(dataparametro); 
var unoDos =$(this).attr('data-unoDos');
   $('#unoDos').val(unoDos);
   
    });

//Aun no lo uso en agenda
$(document).on('click','.editModal',function(){
//asi no funciona cuando retorno de ayax un boton la accion onclick 
 //$(".editModal").click(function(){
  var form_id = $(this).val();
    $("#form_id").val(form_id);
    
    //Otra forma de realizar el get ajax el mismo de infomodal    
    $.get('/beneficiarios/buscar/' + form_id, function (data) {
          //success data
            console.log(data);
            $('#nombre').val(data.nombre);
          $('#apellido').val(data.apellido);
          $('#dui').val(data.dui);
          $('#fechaNac').val(data.fechaNac);
          $('#descripcion').val(data.descripcion);
           });
    //El boton para saber cambair de estado para guardar o modificar 
    $("#btnsave").val("update");
    //$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() + $("#form_id").val() +'</td><td>');

     $('#exampleModal').modal('show');
     //$("#btnsave").removClass("btn btn-primary");//.addClass("btn btn-secondary");
     $("#btnsave").html("Modificar");
     $("#btnsave").removeClass("btn-info");
     $("#btnsave").addClass("btn-success"); 
     ///titulo del modal
     $("#exampleModalLabel").html("Modificar Beneficiario");
      
    });

$("#btnnuevo").click(function(){

  $('#btnsave').val("add");
  $("#btnsave").html("Nuevo");
  $("#btnsave").removeClass("btn-success");
  $("#exampleModalLabel").html("Registro Agenda");
  //$("#tabla").append('<tr id="task"><td>'+ $("#btnsave").val() +'</td><td>');
    //$('#frm').trigger('reset');
    //$('#frmsocios')[0].reset();
$("#exampleModal").modal("show");
  
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
          numAgenda:$('#numAgenda').val(),
          fecha:$('#fecha').val(),
           }       

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btnsave').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();
        var my_url = "/agenda/create";

       if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = '/beneficiarios/update/'+form_id;
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
               $("#msjshow").html(" <strong>Bien hecho!</strong> Registro guardado exitosamente");
               }else{
               $("#msjshow").html(" <strong>Bien hecho!</strong> Registro editado exitosamente");  
               }

                  setTimeout(function(){
                  $("#msjshow").hide();

                  
                $(location).attr('href','/agenda');
                }, 4000);
        },
            error: function (data) {
                console.log('Error de noseq:', data);
               var errors=data.responseJSON;
                console.log(errors);
                
                /*if(errors.nombre!=undefined)
                {
                  $('#nombrefeed').text(errors.nombre);
                  //$( '#nombrediv' ).removeClass();
                  $( '#nombrediv' ).addClass("has-danger");
                }else{
                  $( '#nombrediv' ).removeClass("has-danger");
                  $( '#nombrefeed' ).text("");
                  }
                  */
                
                
            }
        });
    });