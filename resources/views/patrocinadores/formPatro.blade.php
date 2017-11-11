<form id="frm" name="frmpatrocinador" action="/patrocinador/create" method="post">
         <input type="hidden" id="form_id" name="form_id" value="0">
  <div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       

    <div  id="nombrediv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-1 col-form-label offset-1">Nombre</label>
        <div class="col-8 offset-1" >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control" type="text" value="kelvin" id="nombre" name="nombre">
              {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
                <div id="nombrefeed" class="form-control-feedback"></div>
              {{--  @endforeach
            @endif --}}
        </div>
    </div> 
    <div id="descripcionPatrodiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Descripcion</label>
        <div class="col-8 offset-1">
            <textarea class="form-control" type="text" id="descripcionPatro" name="descripcionPatro" value="mi casa" rows="2"></textarea>
            <div id="descripcionPatrofeed" class="form-control-feedback"></div>                   
        </div>
    </div>
  </div>
</div>  
</form>
