@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
	</div>

	<ul class="nav nav-tabs">
		<li class="nav-item ">
			<a class="nav-link active" href="/beneficiarios">Pagos</a>
		<li>
	   

	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>
<div style="width:12%; float:left; padding-right:0px;" id="menu-vertical-pagos">
<div style="clear:both; padding-bottom:15px;">
  </div>
     
         
      <div style="clear:both; padding-bottom:15px;">
      </div>
      
      <div class="list-group " class="padding-bottom:25px;">

    <li class="list-group-item list-group-item-action list-group-item-info active">Periodo</li>
       
   {{--   <a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
        @forelse($anhos as $anho)
        <div style="display:none;">
            $h={{ $anho->año }}
        </div>
       <a href="/pagos/{{ $idsocio }}/{{ $anho->año }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
      {{ $anho->año }}
      </a>
        @empty
        <p>No hay mensajes destacados</p>
        @endforelse       
      </div>  
  </div>
		
 	<div style="width:87%; float:right;">

 	<div class="card">
 	 <div class="card-block">
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Pagos de {{ $nombreSocio }} <strong class="text-danger">            DEUDA: {{ $deuda }} </strong></h6>
        

 		<div class="row" >
 		{{--<div class="col-6" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Donaciones de Club Activo 20-30 </label>	
     	</div>--}}
      <div class="col-6">
        <label style="text-align:left; font-size:18px; "></label>  
      </div>
     	{{--<div class="form-group row col-6 ">
 	        <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>no lleva buscador este de donaciones por ser pocos --}}
  	  </div>
<div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

<table class="table table-bordered  table-hover table-sm " align="center">
  <thead id="theadrow" name="theadrow">{{-- no lo ocupo el id este por el momento --}}
          <tr>
            <th class="center " style="text-color:#000000;">Fecha</th>
            <th class="center" >Meses</th>
            <th class="center " style="text-color:#000000;">Monto</th>
            
            
            <th class="center">Año</th>
            {{--@if($tipo=='Realizada')   @endif --}}       
            <th style="text-align: center">Estado</th>
           
            <th style="text-align: center">Accion</th>
          </tr>
  </thead>
  <tbody id="tabla" name="tabla">
    <div style="display:none;">{{ $contador=0 }}</div>
    @forelse($pagos as $pago)
    <tr id="trow{{ $pago->id }}">
      <td class="text-center" >{{ $pago->fechaPago }}</td>
      <td style="font-size:14px">Cutoa mes {{ $pago->mes }}</td>
      <td class="text-right">$ {{ $pago->monto }}</td> 
      
      
      <td class="text-center">{{ $pago->año }}</td>

      <td class="text-center @if($pago->estado=='CANCELADO') text-success @else text-danger @endif "  style="font-size:13px">{{ $pago->estado }}</td>
      <td class="text-center">
       @if($pago->estado=='PENDIENTE')
        <button style="font-size:12px" type="button" class="btn btn-outline-primary btn-sm infomodal" value="{{ $pago->idsocios }}">Hacer Pago</button>
       @else
        <button style="font-size:12px" type="button" class="btn btn-outline-secondary btn-sm infomodal" value="{{ $pago->idsocios }}">Hacer Recibo</button>
      @endif
       </td>

        </tr>
    @empty
      <p>No hay mensajes destacados</p>
      @endforelse
            
    </tbody>


  </table>
{{--@if(count($solicitantes))@endif
  <div class="mt-2 mx-auto">
  {{ $donaciones->links('
  pagination::bootstrap-4') }}
  </div>--}}


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
       <input  class="form-control" type="text"  id="periodoActual" name="periodoActual" value="">   
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
