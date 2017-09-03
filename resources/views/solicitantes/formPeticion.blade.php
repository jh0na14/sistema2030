<form id="frm" name="frmsocios" action="/socios/create" method="post">
  {{-- soli de solicitante por que es el id que necesito para metern en peticion sera este id
        el foranero de la tabla peticion --}}
         
         <input type="hidden"  id="soli_id" name="soli_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;"></h6></div>       
    <div  id="titulodiv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-3 col-form-label ">Titulo: *</label>
        <div class="col-9 " >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control" type="text"  id="titulo" name="titulo">
              {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
                <div id="titulofeed" class="form-control-feedback"></div>
              {{--  @endforeach
            @endif --}}
        </div>
    </div>
     <div id="descripciondiv" class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label ">Descripcion:*</label>
        <div class="col-9 ">
            <textarea class="form-control" type="text" id="descripcion" name="descripcion" value="mi casa" rows="2"></textarea>
            <div id="descripcionfeed" class="form-control-feedback"></div>                   
        </div>
    </div>
    <div id="noMostrar">{{-- esta para la hora de modificar peticion solo muestre dos coampos a modificar --}}
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Beneficiario:*</label>
        <div class="col-8">
            <select  class="beneid" id="bene_id" name="bene_id">
                
            </select><i class="glyphicon glyphicon-th"></i>ss</span>

            <div id="bene_idfeed" class="form-control-feedback">dui: 12345678-5</div>                   
       </div>
       <div class="col-1"><span class="input-group-btn">
        <button class="btn btn-secondary btn-sm" type="button"></button>
      </span>
        <button type="button" class="btn btn-outline-primary btn-sm" style="margin-right:8px;"></button>
       </div>

    </div>
    </div>

</div>
</div>
</form>
