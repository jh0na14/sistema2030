<form id="frm" name="frmsocios" action="/socios/create" method="post">
  {{-- soli de solicitante por que es el id que necesito para metern en peticion sera este id
        el foranero de la tabla peticion --}}
         
         <input   id="proyecto_id" name="proyecto_id" value="0">
<div class="card">
  <div class="card-block">
    <div class="row"><h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;"></h6></div>       
    <div  id="montodiv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-3 col-form-label ">Monto: *</label>
        <div class="col-9 " >
            <input class="form-control" type="number"  id="monto" name="monto">
                <div id="montofeed" class="form-control-feedback"></div>
        </div>
    </div>
     <div id="descripciondiv" class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label ">Descripcion:*</label>
        <div class="col-9">
            <textarea class="form-control" type="text" id="descripcion" name="descripcion" value="mi casa" rows="2"></textarea>
            <div id="descripcionfeed" class="form-control-feedback"></div>                   
        </div>
    </div>
     <div id="fechadiv" class="form-group row">
        <label for="example-date-input" class="col-3 col-form-label">Fecha:*</label>
        <div class="col-9 ">
            <input class="form-control " type="date" value="2011-07-07" id="fecha" name="fecha">
            <div id="fechafeed" class="form-control-feedback"></div>              
       
        </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-3 col-form-label ">Categoria: *</label>
        <div class="col-9">
            <select class="form-control" id="categoria" name="categoria">
                <option>Spot</option>
                <option>Total</option>
            </select> 
       </div>
    </div>
 

    

</div>
</div>
</form>
