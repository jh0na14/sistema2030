@extends('layouts.app')
@section('content')	
<style type="text/css">
    textarea {
    /*resize: none;*/
    overflow: hidden;
    min-height: auto !important;
    max-height: 150px;

}
</style>
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	
  <ul class="nav nav-tabs">
    <li class="nav-item  active">
      <a class="nav-link "  href="/agenda">Agenda</a>
    <li>
    <li class="nav-item  active">
      <a class="nav-link active ">Acta</a>
    <li>
  
  </ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>

 	<div style="width:100%; float:left;">
    <div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

 	<div class="card">
 	 <div class="card-block">
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Agenda <strong  align="right" class="text-danger"># {{$numAgenda}}</strong> de Club Activo 20-30</h6>
        

  	@forelse($agendas as $agenda)
     <div style="display: none;"{{----}}>
          <input type="text" id="idAgenda" name="idAgenda" value="{{ $agenda->id }}">idAgenda<br>
         <input type="text" id="unoDos" name="unoDos" value="1">1 o 2<br>
         <input type="text" id="ids" name="ids" value="1">ids de puntos y sub al modificar<br>
         <input type="text" id="nombreTextArea" name="nombreTextArea" value="">nombre e id del textarea<br>
       <div class="row" >
      <div class="col-0">
        <label style="text-align:left; font-weight:bold; font-size:20px; "></label> 
      </div>
      <div class="form-group row col-10">
   <label for="example-text-input"  class="col-2 col-form-label offset-1"></label>
        <div class="col-8">
              <input  class="form-control" placeholder="Nombre" type="text" id="etPuntos" name="etPuntos" autofocus disabled>             
          </div>
        <div class="col-1">
          <button type="button" class="btn btn-outline-success " value="add" id="addPunto" name="addPunto">
        <img class="rounded-circle" src="{{asset('icons/boton-anadir.png')}}" height="10" width="10">
        Añadir      
      </button>
          </div>
      
    </div>
      </div>{{-- fin display none--}}

     </div>

    <div class="row" style="clear:both; padding-top:15px;">
      <div class="form-group row col-6 has-success">
       <label for="example-text-input"  class="col-3 col-form-label offset-1">Hora Inicio:</label>
        <div class="col-8">
              <input class="form-control" placeholder="--:--" type="text" id="horaInicio" name="horaInicio" value="{{ $agenda->horaInicio }}">             
          </div>
      </div>
      <div class="form-group row col-6">
       <label for="example-text-input"  class="col-3 col-form-label offset-1">Hora Fin:</label>
        <div class="col-8">
              <input class="form-control" placeholder="--:--" type="text" id="horaFin" name="horaFin" value="{{ $agenda->horaFin }}">             
          </div>
      </div>
  </div>
		
    {{--  @if($agenda->horaInicio==null)
      <td style="text-align: center">--:--</td>
      @else
      <td style="text-align: center">{{ $agenda->horaInicio }}</td>
      @endif
      @if($agenda->horaFin==null)
      <td style="text-align: center">--:--</td>
      @else
      <td style="text-align: center">{{ $agenda->horaFin }}</td>
      @endif  
      --}}
			
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse

<div id="msjshow2" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

  <table class="table {{--table-bordered--}}  table-hover table-sm  " align="center">
  <thead >
   <tr>
              <th colspan="4" style="text-align:center; font-weight:bold; letter-spacing:5px;">Puntos</th>
              
          </tr>
  </thead>
  <thead >
          <tr>
            <th style="text-align: center; width:5%;" style="text-color:#000000;"></th>
              <th style="text-align: left; width:30%;"></th>
              <th style="text-align: right; width:60%;"></th>
               <th style="text-align: center; width:5%;" style="text-color:#000000;"></th>
            
          </tr>
  </thead>
  <tbody id="tablaPuntos" name="tablaPuntos">
    <div id="content">
    {{--@forelse($beneficiarios as $beneficiario)
    --}}
    <tr id="trow">
      
      <td class="text-left">
        <button type="button" class="btn btn-outline-primary btn-sm unoAccion" value="1">1</button>
        <button type="button" class="btn btn-outline-info btn-sm dosAccion" value="2">2</button>
      </td>
  <td style="font-weight:bold;">Puto de oracion ala bandera</td>
      <td> 
        <button type="button" class="btn btn-outline-secondary btn-sm eliminar" value="">
        <img class="rounded-circle" src="{{asset('icons/boton-borrar.png')}}" height="10" width="10">
      </button>
         <button type="button" class="btn btn-outline-secondary btn-sm arriba" value="">
        <img class="rounded-circle" src="{{asset('icons/boton-arriba.png')}}" height="10" width="10">
      </button>
        <button type="button" class="btn btn-outline-secondary btn-sm abajo" value="">
        <img class="rounded-circle" src="{{asset('icons/boton-abajo.png')}}" height="10" width="10">
      </button>
     
       </td>
        </tr>
       
    {{--@empty
      <p>No hay mensajes destacados</p>
      @endforelse
        --}} 
        </div>   
    </tbody>


  </table>

{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Puntos de Agenda</h4>
                        </div>
                        <div class="modal-body">
                           <div style="width:100%; float:right;">
    </div>
    

                        </div>
                        <div class="modal-footer">
                        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       
                        {{--	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       
                            <button type="button" class="btn btn-primary" id="btn-saveiuy" value="add" data-toggle="modal" data-target="#exampleModal">Save changes</button>
                           --}}
                        </div>
                    </div>
                </div>
       </div>
   </div>
{{-- //////////////FIN MODLA--}}
<!-- Modal -->
<div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " style="width: 1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            @include('agendas.formAgenda')
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave" value="Anhadir">Save changes</button>
      </div>
    </div>
  </div>
</div>	
{{-- /////////////////////FIN--}}
	
  
	</div>{{--fin cards--}}
	</div>{{--fin cards--}}
	{{-- FIn style width 85% --}}</div>



	
	
	<div style="clear:both;"></div>
@endsection

@section('script')
  <script src="{{asset('js/acta.js')}}"></script>

@endsection
