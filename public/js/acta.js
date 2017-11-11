function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

$(document).ready(function(){
     //$('#horaini').mask('99:99');

  $('#content').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
  $("#noMostrar").hide();
   var value=$('#idAgenda').val();
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
                    
             row +='<tr id="trow' + data[i][j].id+ '">';
             if(data[i][j].nivel==1){
             row +='<td class="text-center">';
            //  row +='<button type="button" class="btn btn-outline-primary btn-sm unoAccion" value="' + data[i][j].id + '">1</button> ';
             row +='</td>';
             row +='<td style="font-weight:bold; padding-top:12px;">' +k + ' &nbsp&nbsp' + data[i][j].nombre + '</td>'; 
            }
             if(data[i][j].nivel==2){
             row +='<td class="text-center">';
             //row +='<button type="button" class="btn btn-outline-secondary btn-sm dosAccion" value="' + data[i][j].id + '">2</button>';
             row +='</td>';
             row +='<td style="font-weight:bold;  padding-top:12px; ">&nbsp&nbsp&nbsp' +k + '.' +l + ' &nbsp&nbsp' + data[i][j].nombre + '</td>';
            }
             if(data[i][j].descripcion==null){
             // row +='<td style=" padding-top:12px; padding-bottom:12px;">' + data[i][j].descripcion + '</td>'; 
           
             row +='<td style="font-weight:bold;"><div id="divetn' + data[i][j].nivel+ 'x' + data[i][j].id+ '"><textarea onkeyup="auto_grow(this)" class="form-control" rows="2" placeholder="..." type="text" id="etn' + data[i][j].nivel+ 'x' + data[i][j].id+ '" name="etn' + data[i][j].nivel+ 'x' + data[i][j].id+ '" ></textarea></div></td>';
             }else{
              //row +='<td style=" padding-top:12px; padding-bottom:12px;">' + data[i][j].descripcion + '</td>'; 
          
              row +='<td style="font-weight:bold;"><div id="divetn' + data[i][j].nivel+ 'x' + data[i][j].id+ '"><textarea onkeyup="auto_grow(this)" class="form-control" rows="2" placeholder="..." type="text" id="etn' + data[i][j].nivel+ 'x' + data[i][j].id+ '" name="etn' + data[i][j].nivel+ 'x' + data[i][j].id+ '" >' + data[i][j].descripcion+ '</textarea></div></td>';
             }
              row +='<td style="font-weight:bold; padding-top:12px;">';
            
             row +='</button> ';
             row +='<button type="button" class="btn btn-outline-primary btn-sm editPunto" data-nombre="' + data[i][j].nombre + '" data-unoDos="' + data[i][j].nivel + '" value="' + data[i][j].id + '">Guardar';
             row +='</button> ';
             if(data[i][j].descripcion!=null){
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


$(document).on('click','.editPunto',function(){
   var value = $(this).val(); 
  // $('#etPuntos').prop("disabled",false);
   $('#etPuntos').focus();  
   $('#addPunto').html("Modificar");  
 var unoDos =$(this).attr('data-unoDos');
   $('#unoDos').val(unoDos);
 
   $('#ids').val(value);
   $('#addPunto').val("edit");
  $('#etPuntos').val($('#etn'+$('#unoDos').val()+'x'+value).val()); 
  $('#nombreTextArea').val('etn'+$('#unoDos').val()+'x'+value); 
  


$("#addPunto").click();
   
    }); 


//$(document).on('click','.addPunto',function(){
$("#addPunto").click(function (e) {
  var nivel= $('#unoDos').val();
 // $('#etPuntos').prop("disabled",true); 
  
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var state = $(this).val();
        var type = "POST"; //for creating new resource
        //var form_id = $('#form_id').val();
        

       if (state == "edit"){
        var formData = {
            nivel:nivel,
            descripcion:$('#etPuntos').val(),
            horaInicio:$('#horaInicio').val(),
            horaFin:$('#horaFin').val(),
            idAgenda:$('#idAgenda').val(),
            //idpuntos:$('#idpuntos').val(),
            } 
            type = "PUT"; //for updating existing resource
            my_url = '/acta/updatePuntos/'+$('#ids').val();
        }
        
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data);
              $("#msjshow2").show();
              if(state=="edit"){
               $("#msjshow2").html(" <strong>Punto guardado exitosamente");  
               }
               $('#'+'divetn'+nivel+'x'+$('#ids').val()).addClass("has-success"); 
  

           
               setTimeout(function(){
                  $("#msjshow2").hide();
                //$(location).attr('href','/agenda');
                }, 1500);

               
            },
            error: function (data) {
                console.log('Error de noseq:', data);
               var errors=data.responseJSON;
                console.log(errors);
                
              
            }
        });

    });




  