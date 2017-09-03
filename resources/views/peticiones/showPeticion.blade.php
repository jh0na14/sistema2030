@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">

	</div>

	<ul class="nav nav-tabs">
		<li class="nav-item ">
			<a class="nav-link" href="/beneficiarios">Beneficiarios</a>
		<li>
	    <li class="nav-item ">
			<a class="nav-link  " href="/solicitantes">Solicitantes</a>
		<li>
    <li class="nav-item ">
      <a class="nav-link active" href="/peticiones">Peticiones</a>
    <li>

	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>
<div style="width:12%; float:left; padding-right:0px;" id="menu-vertical-pagos">
<div style="clear:both; padding-bottom:15px;">
  </div>
     
    <div class="list-group " class="padding-bottom:25px;">

  {{--   <li href="/pagos/index/" class="list-group-item list-group-item-action list-group-item-info active">Estado</li>
      
 <a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
      <a href="/peticiones" id="count" class="list-group-item list-group-item-action justify-content-between
        @if($estado=='Disponible')active  @endif">Disponibles <span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/peticiones/1" id="count" class="list-group-item list-group-item-action justify-content-between
       @if($estado=='En Progreso')active @endif ">En Progreso <span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/peticiones/2" id="count2" class="list-group-item list-group-item-action justify-content-between
       @if($estado=='Finalizado')list-group-item-danger active @endif ">Finalizados<span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/peticiones/3" id="count" class="list-group-item list-group-item-action justify-content-between
       @if($estado=='Cancelado')list-group-item-danger active @endif ">Cancelados<span class="badge badge-default badge-pill"></span>
      </a>
        
      </div> 
      
      <div style="clear:both; padding-bottom:15px;">
      </div>
      
      <div class="list-group " class="padding-bottom:25px;">

    <li class="list-group-item list-group-item-action list-group-item-info active">Semestre</li>
       
   {{--   <a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
        @forelse($periodos as $periodo)
        <div style="display:none;">
            @if($estado=='Disponible'){{ $x=1 }}@endif
            @if($estado=='En Progreso'){{ $x=2 }}@endif
            @if($estado=='Finalizado'){{ $x=3 }} @endif 
            $h={{ $periodo->id }}
        </div>
        {{--  Para que no se vea en el navegador Sin%20Fnalizar --}}
        @if($estado=='En Progreso')
       <a href="/peticiones/EnProgreso/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
      {{ $periodo->semestre }}
      </a>
      @else
      <a href="/peticiones/{{ $estado }}/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
      {{ $periodo->semestre }}
      </a>
      @endif
      
        @empty
        <p>No hay mensajes destacados</p>
        @endforelse       
      </div>  
  </div>
		
 	<div style="width:87%; float:right;">

 	<div class="card">
 	 <div class="card-block">
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Peticiones a Club Activo 20-30 <strong>PERIODO {{ $periodoActual }}</strong></h6>
        

 		<div class="row" >
 		{{--<div class="col-6" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Beneficiarios de Club Activo 20-30 </label>	
     	</div>--}}
      <div class="col-6">
        <label style="text-align:left; font-size:18px; ">Se pueden realizar proyectos para luego calendarizarlos</label>  
      </div>
     	<div class="form-group row col-6 ">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>
  	  </div>
<div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>
 	<table class="table {{--table-bordered--}}  table-hover table-sm " align="center">
	<thead >
	 {{-- <tr>
	            <th colspan="4" style="text-align:center; font-weight:bold; letter-spacing:5px;"> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
	            	
	            </th>
	        
	        </tr>--}}
	</thead>
	<thead >
	        <tr>
            <th style="text-align: center" class="center ">#</th>
	        {{--	--}}<th class="center " style="text-color:#000000;">Titulo</th>
	           	<th class="center ">Descripcion</th>
	            {{--<th class="center ">Estado</th>
	           	
	           	
	           	<th>A&ntilde;o</th>--}}
	          
	           	{{--<th style="text-align: center">Tipo</th>
	           	--}}
	           	<th style="text-align: center">Accion</th>
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($peticiones as $peticion)
		<tr id="trow{{ $peticion->id }}">
      <td style="font-size:14px">#{{ $peticion->id }}</td> 
			<td>{{ $peticion->titulo }}</td>
			<td style="font-size:14px">{{ $peticion->descripcion }}</td>
			<td class="text-center">
        @if($peticion->estado=='Disponible')
        <button type="button" class="btn btn-outline-primary btn-sm proyectoModal" value="{{ $peticion->id }}">Crear Proyecto</button>
				@endif
        <button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $peticion->id }}">Info</button>

        <button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $peticion->id }}">Editar</button>
				@if($peticion->estado=='Disponible')
        <button type="button" class="btn btn-outline-danger btn-sm darBaja" value="{{ $peticion->id }}">Cancelar</button>
        @endif
       </td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($solicitantes))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $peticiones->links('
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            @include('solicitantes.formPeticion')
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave" value="Anhadir">Guardar</button>
      </div>
    </div>
  </div>
</div>	
{{-- /////////////////////FIN--}}
<!-- Modal con tabindex -1 no funciona select2-->
<div class="modal fade" id="Modal3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog {{--modal-lg--}} " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Crear Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            @include('peticiones.formProyecto')
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave2" value="Anhadir">Guardar</button>
      </div>
    </div>
  </div>
</div>  
{{-- /////////////////////FIN--}}	
<!-- Modal con tabindex -1 no funciona select2-->
<div class="modal fade" id="Modal4" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Motivo de cancelacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
           <form>
<div  id="motivodiv" class="form-group row @if($errors->has('nombre')) has-danger @endif" >
        <label for="example-text-input" class="col-3 offset-1 col-form-label ">Explique el motivo de su cancelacion</label>
        <div class="col-7 " >
                <textarea class="form-control" type="text"  id="motivo" name="motivo" rows="2"></textarea>
                <div id="motivofeed" class="form-control-feedback"></div>
        </div>
      </div>
       <input type="hidden" class="form-control" type="text"  id="delete_id" name="delete_id">
          
           </form>

        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="btnsave3">Guardar</button>
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
  <script src="{{asset('js/peticion.js')}}"></script>

@endsection
