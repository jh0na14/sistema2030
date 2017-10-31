@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	<ul class="nav nav-tabs">
		<li class="nav-item  active">
			<a class="nav-link active" href="/beneficiarios">Agenda</a>
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
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Agendas de Club Activo 20-30</h6>
         


  	 {{--<div class="row" >
		<div class="col-4 offset-4">
			<label for="example-text-input" style="text-align:left; font-weight:bold; font-size:20px; " ><i>Beneficiarios de Club Activo 20-30</i></label>
     	</div>
 	 	
	</div>--}}

 		<div class="row" >
 		<div class="col-2" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm"  id="btnnuevo" name="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-0">
  			<label style="text-align:left; font-weight:bold; font-size:20px; "></label>	
     	</div>
     	<div class="form-group row col-10">
 	 <label for="example-text-input"  class="col-2 col-form-label offset-1">Buscar</label>
  			<div class="col-9">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>
  	  </div>

 	<table class="table {{--table-bordered--}}  table-hover table-sm  " align="center">
	<thead >
	 {{-- <tr>
	            <th colspan="4" style="text-align:center; font-weight:bold; letter-spacing:5px;"> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
	            	
	            </th>
	        
	        </tr>--}}
	</thead>
	<thead >
	        <tr>
	        	<th style="text-align: left" style="text-color:#000000;">#</th>
	           	<th style="text-align: center">Fecha</th>
              <th style="text-align: center">Hora Inicio</th>
              <th style="text-align: center">Hora Fin</th>
	           	<th style="text-align: center">Estado</th>
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($agendas as $agenda)
		<tr id="trow{{ $agenda->id }}">
			<td>{{ $agenda->numAgenda }}</td>
      <td style="text-align: center">{{ $agenda->fecha }}</td>
      @if($agenda->horaInicio==null)
      <td style="text-align: center">--:--</td>
      @else
      <td style="text-align: center">{{ $agenda->horaInicio }}</td>
      @endif
      @if($agenda->horaFin==null)
      <td style="text-align: center">--:--</td>
      @else
      <td style="text-align: center">{{ $agenda->horaFin }}</td>
      @endif
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm puntosModal" data-numAgenda="{{ $agenda->numAgenda }}" value="{{ $agenda->id }}">Puntos</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $agenda->id }}">Acta</button>
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($socios))@endif
  <div class="mt-2 mx-auto">
  {{ $beneficiarios->links('
  pagination::bootstrap-4') }}
  </div>--}}


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
    <div id="msjshow2" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

  <div class="card">
   <div class="card-block">
    <h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;"><div id="divnumAgenda" name="divnumAgenda">Agenda #1000</div></h6>
         <div style="display: none;"><input type="text" id="etnumAgenda" name="etnumAgenda"> agenda <br>
         <input type="text" id="unoDos" name="unoDos" value="1">1 o 2<br>
         <input type="text" id="ids" name="ids" value="1">ids de puntos y sub al modificar<br>
         <input type="text" id="idpuntos" name="idpuntos" value="1">id de puntos de talbla sub<br>
         <input type="button" id="btnPuntos" name="btnPuntos" >btnPuntos p/ recargar tabla puntos <br>
        </div>



     {{--<div class="row" >
    <div class="col-4 offset-4">
      <label for="example-text-input" style="text-align:left; font-weight:bold; font-size:20px; " ><i>Beneficiarios de Club Activo 20-30</i></label>
      </div>
    
  </div>--}}

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
      </div>

  <table class="table {{--table-bordered--}}  table-hover table-sm  " align="center">
  <thead >
   <tr>
              <th colspan="3" style="text-align:center; font-weight:bold; letter-spacing:5px;">Puntos</th>
              
          </tr>
  </thead>
  <thead >
          <tr>
            <th style="text-align: center; width:10%;" style="text-color:#000000;"></th>
              <th style="text-align: left; width:75%;"></th>
              <th style="text-align: right; width:25%;"></th>
          </tr>
  </thead>
  <tbody id="tablaPuntos" name="tablaPuntos">
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
    </tbody>


  </table>
{{--@if(count($socios))@endif
  <div class="mt-2 mx-auto">
  {{ $beneficiarios->links('
  pagination::bootstrap-4') }}
  </div>--}}


  </div>{{--fin cards--}}
  </div>{{--fin cards--}}
  {{-- FIn style width derecho 50% --}}</div>
    

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
  <script src="{{asset('js/agenda.js')}}"></script>

@endsection
