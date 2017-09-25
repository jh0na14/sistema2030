@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
	</div>

	<ul class="nav nav-tabs">
     <li class="nav-item ">
      <a href="/controlGastos/Membresia" class="nav-link @if($tipo=='Membresia')active  @endif">
        Membresias </a>
    <li>
    <li class="nav-item ">
      <a href="/controlGastos/Campaña"  class="nav-link  @if($tipo=='Campaña')active @endif ">
        Campañas<span class="badge badge-default badge-pill"></span>
      </a>
    <li>
       <li class="nav-item ">
      <a href="/controlGastos/Verdugo"  class="nav-link  @if($tipo=='Verdugo')list-group-item-success active @endif">
        Verdugo<span class="badge badge-default badge-pill"></span>
      </a>
    <li>
	

	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>
<div style="width:12%; float:left; padding-right:0px;" id="menu-vertical-pagos">
<div style="clear:both; padding-bottom:35px;">
  </div>
     
   {{--  <div class="list-group " class="padding-bottom:25px;">

    <li href="/pagos/index/" class="list-group-item list-group-item-action list-group-item-info active">Estado</li>
      
 <a href="#" class="list-group-item list-group-item-action list-group-item-info active">Tipo</a> 

      <a href="/controlGastos/Membresia" id="count" class="list-group-item list-group-item-action justify-content-between
        @if($tipo=='Membresia')active  @endif">Membresias <span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/controlGastos/Campaña" id="count" class="list-group-item list-group-item-action justify-content-between
       @if($tipo=='Campaña')active @endif ">Campañas<span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/controlGastos/Verdugo" id="count2" class="list-group-item list-group-item-action justify-content-between
       @if($tipo=='Verdugo')list-group-item-success active @endif">Verdugo<span class="badge badge-default badge-pill"></span>
      </a>
    
      </div> 
      
      <div style="clear:both; padding-bottom:15px;">
      </div>--}}
      
      <div class="list-group " class="padding-bottom:25px;">

    <li class="list-group-item list-group-item-action list-group-item-info active">Periodo</li>
       
   {{--   <a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
        @forelse($periodos as $periodo)
        <div style="display:none;">
           
            $h={{ $periodo->id }}
        </div>
        {{--  Para que no se vea en el navegador Sin%20Fnalizar --}}
        
      <a href="/controlGastos/{{ $tipo }}/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
      {{ $periodo->semestre }}
      </a>
           
        @empty
        <p>No hay mensajes destacados</p>
        @endforelse       
      </div>  
  </div>
		
 	<div style="width:87%; float:right;">

 	<div class="card">
 	 <div class="card-block">
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Ingresos de <strong>{{ $tipo }}</strong> <strong class="text-danger">PERIODO {{ $periodoActual }}</strong></h6>
        

 		<div class="row" >
 		
      <div class="col-6">
        <label style="text-align:left; font-size:18px; "></label>  
      </div>
     	<div class="form-group row col-6 ">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
          @if($tipo=='Membresia')
      				<input class="form-control" placeholder="Busqueda {{ $tipo }}" type="text" id="searchM" name="search" autofocus>             
  				@endif
          @if($tipo=='Campaña')
              <input class="form-control" placeholder="Busqueda {{ $tipo }}" type="text" id="searchC" name="search" autofocus>             
          @endif
          @if($tipo=='Verdugo')
              <input class="form-control" placeholder="Busqueda {{ $tipo }}" type="text" id="searchV" name="search" autofocus>             
          @endif
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
	<thead id="theadrow" name="theadrow">
	        <tr>
            <th style="text-align: center" class="center ">#</th>
	            <th class="center " style="text-color:#000000;">Fecha</th>
	           	<th class="center ">Concepto</th>        
	           	<th style="text-align: center">Ingreso</th>
	           	<th style="text-align: center">Egreso</th>
              <th style="text-align: center">Saldo</th>
	        </tr>

	</thead>
	<tbody id="tabla" name="tabla">
    <div style="display:none;">{{ $contador=0 }}</div>
    @forelse($tablas as $tabla)
		<tr id="trow{{ $tabla->id }}">
      <td style="font-size:14px">#{{ $tabla->fecha }}</td> 
			<td>{{ $tabla->concepto }}</td>
			<td style="font-size:14px">{{ $tabla->ingreso }}</td>
      <td style="font-size:14px">{{ $tabla->egreso }}</td>
      <td style="font-size:14px">{{ $tabla->saldo }}</td>
		{{--<td class="text-center">
        @if($tabla->estado=='Disponible')
        <button type="button" class="btn btn-outline-primary btn-sm proyectoModal" value="{{ $peticion->id }}">Crear Proyecto</button>
				@endif
        @if($tabla->estado=='En Progreso' || $peticion->estado=='Finalizado')
        <button type="button" class="btn btn-outline-info btn-sm infoProyecto" value="{{ $peticion->id }}">Info Proyecto</button>
        @endif
        <button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $peticion->id }}">Info Peticion</button>
        
				@if($tabla->estado=='Disponible')
        <button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $peticion->id }}">Editar</button>
        <button type="button" class="btn btn-outline-danger btn-sm darBaja" value="{{ $peticion->id }}">Cancelar</button>
        @endif
       </td>--}}

        </tr>
		@empty
    	<p>No hay datos</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($solicitantes))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $tablas->links('
  pagination::bootstrap-4') }}
  </div>


{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Datos Personales</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            
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
       <input  class="form-control" type="text"  id="periodoActual" name="periodoActual" value="{{ $periodoActual }}">   
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
