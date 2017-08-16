@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	<ul class="nav nav-tabs">
		<li class="nav-item  active">
			<a class="nav-link active" href="/periodos">Periodos</a>
		<li>
	  

	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>

		
 	<div style="width:100%; float:right;">
    <div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

 	<div class="card">
 	 <div class="card-block">
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Control de Periodos de Club Activo 20-30</h6> 

 		<div class="row" >
 		<div class="col-2" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo Periodo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Periodo de Club Activo 20-30 </label>	
     	</div>
     	<div class="form-group row col-6">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>
  	  </div>

 	<table class="table {{--table-bordered--}}  table-hover table-sm  " align="center">
	<thead >
	        <tr>
	        	<th style="text-align: center" style="text-color:#000000;">#</th>
	           	<th class="center ">Fecha Inicio</th>
	            <th class="center ">Fecha Fin</th>
	          
	           	{{--<th style="text-align: center">Tipo</th>
	           	--}}
	           	<th >Estado</th>
	        <th style="text-align: center">Accion</th>
          </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($periodos as $periodo)
		<tr id="trow{{ $periodo->id }}">
			<td>{{ $periodo->id }}</td>
      <td>{{ $periodo->fechaInicio }}</td>
			<td >{{ $periodo->fechaFin }}</td>
      <td >{{ $periodo->estado }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $periodo->id }}">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $periodo->id }}">Editar</button>
			  @if($periodo->estado =='Finalizado')
        <button type="button" class="btn btn-outline-primary btn-sm" value="{{ $periodo->id }}">Activar</button>
        @else
         <button type="button" class="btn btn-outline-danger btn-sm" value="{{ $periodo->id }}">Desactivar</button>
        @endif
      </td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($socios))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $periodos->links('
  pagination::bootstrap-4') }}
  </div>


{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Datos Personales</h4>
                        </div>
                        <div class="modal-body">
                            <div class="">
                            	<div class="card">
  								<div class="card-block">
    							<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Informacion</h6>
            					<table   class="table {{--table-bordered--}}  table-sm " align="center">
            					<tbody id="tablainfo">
            					</tbody>
            					</table>
            				</div>
            				</div>
					        </div>
                        </div>
                        <div class="modal-footer">
                        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       
               
                           {{-- <button type="button" class="btn btn-primary" id="btn-saveiuy" value="add" data-toggle="modal" data-target="#exampleModal">Save changes</button>
                           --}}
                        </div>
                    </div>
                </div>
       </div>
   </div>
{{-- //////////////FIN MODLA--}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog {{--modal-lg--}} " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            @include('periodos.formPeriodo')
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
  <script src="{{asset('js/periodo.js')}}"></script>

@endsection
