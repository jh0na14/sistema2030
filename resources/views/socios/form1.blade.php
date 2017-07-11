<form id="frmsocios" name="frmsocios" action="/socios/create" method="post">
    <div class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-1 col-form-label offset-1">Nombre</label>
        <div class="col-8 offset-1" >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario --}}
            {{ csrf_field() }}
            <input class="form-control" type="text" value="kelvin" id="nombre" name="nombre">
               @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
            @endif {{----}}
        </div>
    </div>
     <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label offset-1">Apellido</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="text" value="FLores" id="apellido" name="apellido">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-date-input" class="col-1 col-form-label offset-1">Fecha</label>
        <div class="col-8 offset-1">
            <input class="form-control " type="text" value="2011-07-07" id="fechaNac" name="fechaNac">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">DUI</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="text" value="123456789" id="dui" name="dui">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Direccion</label>
        <div class="col-8 offset-1">
            <textarea class="form-control" type="text" id="direccion" name="direccion" value="mi casa" rows="2"></textarea>
        </div>
    </div>
     <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Telefono</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="text" value="1234-4656" id="telefono" name="telefono">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-1 col-form-label offset-1">Email</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="email" value="bootstrap@example.com" id="email" name="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Apodo</label>
        <div class="col-8 offset-1">
         <textarea class="form-control" type="text" id="apodo" name="apodo" value="FLorescucks" rows="2"></textarea>
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
