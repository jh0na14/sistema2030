@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
	</div>

	<ul class="nav nav-tabs">
		<li class="nav-item ">
			<a class="nav-link active" href="/beneficiarios">Proyectos</a>
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
      <a href="/proyectos" id="count" class="list-group-item list-group-item-action justify-content-between
        @if($estado=='Programado')active  @endif">Programados<span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/proyectos/1" id="count" class="list-group-item list-group-item-action justify-content-between
       @if($estado=='Cancelado')active @endif ">Sin Finalizar <span class="badge badge-default badge-pill"></span>
      </a>
      <a href="/proyectos/2" id="count2" class="list-group-item list-group-item-action justify-content-between
       @if($estado=='Finalizado')list-group-item-success active @endif ">Finalizados<span class="badge badge-default badge-pill"></span>
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
            @if($estado=='Programado'){{ $x=1 }}@endif
            @if($estado=='Cancelado'){{ $x=2 }}@endif
            @if($estado=='Finalizado'){{ $x=3 }} @endif 
            $h={{ $periodo->id }}
        </div>
        {{--  Para que no se vea en el navegador Sin%20Fnalizar --}}
        @if($estado=='Cancelado'){{--@if($estado=='En Progreso')--}}
       <a href="/proyectos/SinFinalizar/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
      {{ $periodo->semestre }}
      </a>
      @else
      <a href="/proyectos/{{ $estado }}/{{ $periodo->semestre }}" class="list-group-item list-group-item-action justify-content-between"><span class="badge badge-default badge-pill"></span>
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
  	<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Proyectos de Club Activo 20-30 <strong class="text-danger">PERIODO {{ $periodoActual }}</strong></h6>
        

 		<div class="row" >
 		{{--<div class="col-6" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Beneficiarios de Club Activo 20-30 </label>	
     	</div>--}}
      <div class="col-6">
        <label style="text-align:left; font-size:18px; "></label>  
      </div>
     	{{--<div class="form-group row col-6 ">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>no lleva buscador este proyecto por ser pocos --}}
  	  </div>
<div id="msjshow" style="display: none;" class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>

 <div class="row" id="tabla">
{{--<div id="tabla"></div>finn id tabla --}}

    @forelse($proyectos as $proyecto)
    <div class="col-6">
<div class="card hoverable card-outline- " style="margin-bottom:15px; {{--max-height: 20rem;--}} {{--@if($peticion->id==8)display:none;@endif--}}">
  <div class="card-block">

    <h6 class="card-title">{{ $proyecto->nombre }}</h6>
    {{--<hr>--}}

      <div style="width:99%; float:left; padding-right:0px;" >

         <p class="card-text" style="font-size:13px">{{ $proyecto->descripcion }}</p>
          <small class="text-muted">Tipo {{ $proyecto->tipo}}</small><br>
          <small class="text-muted">Presupuesto ${{ $proyecto->presupuesto}}</small>
              <div class="card-text text-muted float-right" style="font-size:14px">
     
     <small class="text-muted">Finaliza {{ $proyecto->fechaFin}}</small>
   
      </div>

      </div>
       <div style="width:1%; float:left; padding-right:0px;" >
      
      </div>
    </div>
  <div class="progress">
  <div class="progress-bar bg-success" role="progressbar" style="width: 25%; height: 2px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="card-footer" {{--style="background-color: #fBfBfB"--}}>
    @if($proyecto->estado=='Programado')
    <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm donacionModal" value="{{ $proyecto->id }}">Hacer Donacion</button>
   @endif
   @if($proyecto->estado=='Cancelado')
     <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm infoDonacion" value="{{ $proyecto->id }}">InfoDonacion</button>
   @endif
    @if($proyecto->estado=='Finalizado')
     <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm infoDonacion" value="{{ $proyecto->id }}">Info Donacion</button>
   @endif
    <button type="button" style="font-size:12px" class="btn btn-outline-info btn-sm infomodal" value="{{ $proyecto->peticionID }}">Info Peticion</button>    
    <button type="button" style="font-size:12px" class="btn btn-outline-danger btn-sm editModal" value="{{ $proyecto->id }}">Eliminar</button>
      
</div> 

</div>{{-- fin card--}}  

</div> {{--fin col--}}   
    @empty
      <p>No hay Peticiones</p>
      @endforelse
       

</div>{{-- fin row antes de col--}}
{{--@if(count($solicitantes))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $proyectos->links('
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
  <script src="{{asset('js/proyecto.js')}}"></script>

@endsection
