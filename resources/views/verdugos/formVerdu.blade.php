<form id="frm" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="form_id" name="form_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       
    <div  id="fechaPagodiv" class="form-group row @if($errors->has('fechaPago')) has-danger @endif" >
        <label for="example-text-input" class="col-3 col-form-label ">Fecha Pago: *</label>
        <div class="col-9 " >
             {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control" type="text"  id="fechaPago" name="fechaPago">
              {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
                <div id="fechaPagofeed" class="form-control-feedback"></div>
              {{--  @endforeach
            @endif --}}
        </div>
    </div>
     <div id="montoRecaudadodiv" class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label ">Monto Recaudado: *</label>
        <div class="col-9">
            <input class="form-control" type="text" value="" id="montoRecaudado" name="montoRecaudado">
            <div id="montoRecaudadofeed" class="form-control-feedback"></div>              
        </div>
    </div>
    
    <div id="montoRifadiv" class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label ">Monto Rifa: *</label>
        <div class="col-9">
            <input class="form-control" type="text"  id="montoRifa" name="montoRifa">
            <div id="montoRifafeed" class="form-control-feedback"></div>              
        </div>
    </div>
 
    
</div>
</div>
</form>
