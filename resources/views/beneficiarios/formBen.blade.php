<form id="frm" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="form_id" name="form_id" value="0">
       
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
     <div id="apellidodiv" class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label offset-1">Apellido</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="text" value="FLores" id="apellido" name="apellido">
            <div id="apellidofeed" class="form-control-feedback"></div>              
        </div>
    </div>
    <div id="fechaNacdiv" class="form-group row">
        <label for="example-date-input" class="col-1 col-form-label offset-1">Fecha Ingreso</label>
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
    <div id="descripciondiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Descripcion</label>
        <div class="col-8 offset-1">
            <textarea class="form-control" type="text" id="descripcion" name="descripcion" value="mi casa" rows="2"></textarea>
            <div id="descripcionfeed" class="form-control-feedback"></div>                   
        </div>
    </div>
    {{--<div id="telefonodiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label offset-1">Telefono</label>
        <div class="col-8 offset-1">
            <input class="form-control" type="number" value="1234-4656" id="telefono" name="telefono">
            <div id="telefonofeed" class="form-control-feedback"></div>               
        </div>
    </div>--}}
    
</form>
