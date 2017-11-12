@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
	</div>

	<ul class="nav nav-tabs">
		<li class="nav-item ">
			<a class="nav-link active" href="/beneficiarios">Donaciones</a>
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
      <a href="/donaciones" id="count" class="list-group-item list-group-item-action justify-content-between
        @if($tipo=='Realizada')active  @endif">Realizadas<span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/donaciones/Recibidas" id="count" class="list-group-item list-group-item-action justify-content-between
       @if($tipo=='Recibida')list-group-item-success active @endif ">Recibidas<span class="badge badge-default badge-pill"></span>
      </a>
        
      </div> 
      
      <div style="clear:both; padding-bottom:15px;">
      </div>
      
      <div class="list-group " class="padding-bottom:25px;">

    <li class="list-group-item list-group-item-action list-group-item-info active">Periodo</li>
       
   {{--   <a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
        @forelse($periodos as $periodo)
        <div style="display:none;">
            $h={{ $periodo->id }}
        </div>
       <a href="/donaciones/{{ $tipo }}/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
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
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Donaciones @if($tipo=='Realizada') Realizadas @endif
    @if($tipo=='Recibida') Recibidas @endif de Club Activo 20-30 <strong class="text-danger">PERIODO {{ $periodoActual }}</strong></h6>
    <div align="right" style="padding-bottom:5px;">
    <button type="button" align="center" class="btn btn-outline-info btn-sm imprimir" value=""
       data-toggle="tooltip" data-placement="top" data-tipo="{{ $tipo }}" data-periodo="{{ $periodoActual }}" title="Imprimir">
             <img class="" src="{{asset('icons/impresora.png')}}" height="17" width="17">
         
         </button>      
    </div>
 		{{--<div class="row" >--}}
 		{{--<div class="col-6" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Donaciones de Club Activo 20-30 </label>	
     	</div>--}}
      {{--<div class="col-6">
        <label style="text-align:left; font-size:18px; "></label>  
      </div>--}}
     	{{--<div class="form-group row col-6 ">
 	        <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>no lleva buscador este de donaciones por ser pocos --}}
  	 {{-- </div>--}}

<div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

<table class="table {{--table-bordered--}}  table-hover table-sm " align="center">
  <thead id="theadrow" name="theadrow">{{-- no lo ocupo el id este por el momento --}}
          <tr>
            <th class="center" >Fecha</th>
            <th class="center " style="text-color:#000000;">Descripcion</th>
            @if($tipo=='Recibida')
            <th class="center " style="text-color:#000000;">Patrocinador</th>
            @endif
            <th class="center">Monto</th>
            {{--@if($tipo=='Realizada')   @endif --}}       
            <th style="text-align: center">Tipo</th>
            @if($tipo=='Realizada')
            <th style="text-align: center">Accion</th>
            @endif
          </tr>
  </thead>
  <tbody id="tabla" name="tabla">
    <div style="display:none;">{{ $contador=0 }}</div>
    @forelse($donaciones as $donacion)
    <tr id="trow{{ $donacion->id }}">
      <td style="font-size:14px">{{ $donacion->fecha }}</td>
      <td >{{ $donacion->descripcion }}</td> 
       @if($tipo=='Recibida')
      <td >{{ $donacion->nombre }}</td> 
      @endif
      <td>$ {{ $donacion->monto }}</td>
      <td class="text-center">{{ $donacion->categoria }}</td>
      <td class="text-center">
        @if($donacion->tipo=='Realizada')
        <button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $donacion->idpeticions }}">Info Peticion</button>
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
  {{ $donaciones->links('
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
            @include('proyectos.formDonacion')
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
  <script src="{{asset('js/donaciones.js')}}"></script>

@endsection
