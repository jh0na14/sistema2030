<form id="frm" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="soli_id" name="soli_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       
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
    <div id="fechadiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha: *</label>
        <div class="col-9">
            <input class="form-control " type="date" value="2011-07-07" id="fecha" name="fecha">
            <div id="fechafeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Beneficiario: *</label>
        <div class="col-9">
            <select class="form-control" id="bene_id" name="bene_id">
                <option>Sin Cargo</option>
                <option>Presidente</option>
                <option>Secretario</option>
                <option>Tesorero</option>
            </select> 
       </div>
    </div>
</div>
</div>
</form>
