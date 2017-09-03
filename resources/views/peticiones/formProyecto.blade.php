<form id="frm" name="frmsocios" action="/socios/create" method="post">
        {{-- peticion por que es el id que necesito para metern en proyecto sera este id
        el foranero de la tabla proyecto --}}
         <input type="hidden"  id="peticion_id" name="peticion_id" >
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       
    <div  id="nombrediv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-3 col-form-label ">Nombre: *</label>
        <div class="col-9 " >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control" type="text"  id="nombre" name="nombre">
              {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
                <div id="nombrefeed" class="form-control-feedback"></div>
              {{--  @endforeach
            @endif --}}
        </div>
    </div>
    <div id="fechaIniciodiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha Inicio:*</label>
        <div class="col-9">
            <input class="form-control " type="date" id="fechaInicio" name="fechaInicio">
            <div id="fechaIniciofeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    
    <div id="fechaFindiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha Fin:*</label>
        <div class="col-9">
            <input class="form-control " type="date" id="fechaFin" name="fechaFin">
            <div id="fechaFinfeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    <div id="presupuestodiv" class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label ">Presupuesto:*</label>
        <div class="col-9">
            <input class="form-control" type="number" value="" id="presupuesto" name="presupuesto">
            <div id="presupuestofeed" class="form-control-feedback"></div>              
        </div>
    </div>
        
    
    </div>
</div>
</form>
