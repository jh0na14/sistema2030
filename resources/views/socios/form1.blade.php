<form id="frmsocios" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="socio_id" name="socio_id" value="0">
    <div class="row">
    <div  id="nombrediv" class="form-group row col-6 @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-1 col-form-label offset-1">Nombre</label>
        <div class="col-9 offset-1" >
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
     <div id="apellidodiv" class="form-group row col-6">
        <label for="example-text-input" class="col-1 col-form-label offset-1">Apellido</label>
        <div class="col-9 offset-1">
            <input class="form-control" type="text" value="FLores" id="apellido" name="apellido">
            <div id="apellidofeed" class="form-control-feedback"></div>              
        </div>
    </div>
    </div>
    <div id="fechaNacdiv" class="form-group row">
        <label for="example-date-input" class="col-1 col-form-label offset-1">Fecha</label>
        <div class="col-8 offset-1">
            <input class="form-control " type="text" value="2011-07-07" id="fechaNac" name="fechaNac">
            <div id="fechaNacfeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    <div id="duidiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">DUI</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="text" value="123456789" id="dui" name="dui">
            <div id="duifeed" class="form-control-feedback"></div>              
        </div>
    </div>
    <div id="direcciondiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Direccion</label>
        <div class="col-8 offset-1">
            <textarea class="form-control" type="text" id="direccion" name="direccion" value="mi casa" rows="2"></textarea>
            <div id="direccionfeed" class="form-control-feedback"></div>                   
        </div>
    </div>
     <div id="telefonodiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Telefono</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="number" value="1234-4656" id="telefono" name="telefono">
            <div id="telefonofeed" class="form-control-feedback"></div>               
        </div>
    </div>
    <div id="emaildiv" class="form-group row">
        <label for="example-email-input" class="col-1 col-form-label offset-1">Email</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="email" value="bootstrap@example.com" id="email" name="email">
            <div id="emailfeed" class="form-control-feedback"></div>             
        </div>
    </div>
    <div id="apododiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Apodo</label>
        <div class="col-8 offset-1">
         <textarea class="form-control" type="text" id="apodo" name="apodo" value="FLorescucks" rows="2"></textarea>
         <div id="apodofeed" class="form-control-feedback"></div>              
        </div>
    </div>
   <div class="form-group row">
        <label for="example-email-input" class="col-1 col-form-label offset-1">Tipo</label>
        <div class="col-8 offset-1">
            <select class="form-control" id="tipoSocio" name="tipoSocio">
                <option>Socio Activo</option>
                <option>Activo Mayor</option>
            </select> 
       </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-1 col-form-label offset-1">Cargo</label>
        <div class="col-8 offset-1">
            <select class="form-control" id="cargo" name="cargo">
                <option>Sin Cargo</option>
                <option>Presidente</option>
                <option>Secretario</option>
                <option>Tesorero</option>
            </select> 
       </div>
    </div>

    
</form>
