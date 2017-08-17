<form id="frm" name="frmsocios" action="/socios/create" method="post">
         <input type="hidden" id="form_id" name="form_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Formulario</h6></div>       
    <div id="fechaIniciodiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha Inicio:*</label>
        <div class="col-9">
              {{-- Token ue genera laravel es obligatorio
            debido a laraevl provee seguridad y da el toen 
            para que lo econozca que es nuestro formulario 
            {{ csrf_field() }} --}}
            <input class="form-control " type="date" value="2011-07-07" id="fechaInicio" name="fechaInicio">
            {{-- @if($errors->has('nombre')) 
               @foreach($errors->get('nombre') as $error)--}}
            <div id="fechaIniciofeed" class="form-control-feedback"></div>              
            {{--  @endforeach
                @endif --}}
        </div>
    </div>
    <div id="fechaFindiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label ">Fecha Fin: *</label>
        <div class="col-9">
            <input class="form-control " type="date" value="2011-07-07" id="fechaFin" name="fechaFin">
            <div id="fechaFinfeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    <div id="semestrediv" class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Semestre:*</label>
        <div class="col-5">
            <select class="form-control form-control-sm" id="semestre" name="semestre">
                <option>I</option>
                <option>II</option>
                
            </select>
             <div id="semestrefeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    {{--
<div class="form-inline">
  
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Jane Doe">

  <label class="sr-only" for="inlineFormInputGroup">Username</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@</div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
  </div>

  <div class="form-check mb-2 mr-sm-2 mb-sm-0">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox"> Remember me
    </label>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</div>--}}
    
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Presidente:*</label>
        <div class="col-8">

            <select  id="socio1" name="socio1">
            </select>
            <div id="socio1feed" class="form-control-feedback">dui: 12345678-5</div>                   
       </div>
       <div class="col-1"><span class="input-group-btn">
        {{--<button class="btn btn-secondary btn-sm" type="button"></button>--}}
      </span>

        <button type="button" class="btn btn-outline-secondary btn-sm" style="margin-rigth:5px;">+</button>
       </div>

    </div>
    
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Tesorero:*</label>
        <div class="col-8">
            <select  id="socio2" name="socio2">
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Secretario:*</label>
        <div class="col-8">
            <select  id="socio3" name="socio3">
            </select>
       </div>
    </div>
{{--
    <div id="telefonodiv" class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label ">Telefono</label>
        <div class="col-9 offset-2">
            <input class="form-control" type="number"  id="telefono" name="telefono">
            <div id="telefonofeed" class="form-control-feedback"></div>               
        </div>
    </div>--}}
</div>
</div>
</form>
