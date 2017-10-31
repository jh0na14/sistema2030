<form id="frm" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="form_id" name="form_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       
    <div  id="numAgendadiv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-3 col-form-label ">Numero Agenda:*</label>
        <div class="col-9 " >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control" type="text"  id="numAgenda" name="numAgenda">
              {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
                <div id="numAgendafeed" class="form-control-feedback"></div>
              {{--  @endforeach
            @endif --}}
        </div>
    </div>
    <div id="fechadiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha Ingreso: *</label>
        <div class="col-9">
            <input class="form-control " type="date" value="" id="fecha" name="fecha">
            <div id="fechafeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
     <div id="noMostrar">{{-- esta para la hora de inngresar en patrocinadores no va este campo --}}
    
    <div id="duidiv" class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label ">Hora Inicio:*</label>
        <div class="col-9">
            <input class="form-control" type="text"  id="horaInicio" name="horaInicio">
            <div id="duifeed" class="form-control-feedback"></div>              
        </div>
    </div>
    <div id="descripciondiv" class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label ">Hora Fin:*</label>
        <div class="col-9 ">
            <textarea class="form-control" type="text" id="HoraFin" name="horaFin" value="mi casa" rows="2"></textarea>
            <div id="descripcionfeed" class="form-control-feedback"></div>                   
        </div>
    </div>
    </div>
    {{--<div id="telefonodiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label ">Telefono</label>
        <div class="col-9 offset-2">
            <input class="form-control" type="number"  id="telefono" name="telefono">
            <div id="telefonofeed" class="form-control-feedback"></div>               
        </div>
    </div>--}}
</div>
</div>
</form>
