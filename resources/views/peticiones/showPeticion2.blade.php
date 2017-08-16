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

		<div style="width:14%; float:left; padding-right:0px;" id="menu-vertical-pagos">
<div style="clear:both; padding-bottom:35px;">
  </div>
     
    <div class="list-group " class="padding-bottom:25px;">

      <li href="/pagos/index/" class="list-group-item list-group-item-action list-group-item-info active">Tipos{{--A&ntilde;os--}}</li>
      
{{--<a href="#" class="list-group-item list-group-item-action list-group-item-info active">These Boots Are </a> 
--}}
        <a href="/socios/2" id="count" class="list-group-item list-group-item-action justify-content-between">Sin Finalizar <span class="badge badge-default badge-pill"></span></a>
        <a href="/socios/3" id="count2" class="list-group-item list-group-item-action justify-content-between">Finalizados<span class="badge badge-default badge-pill"></span></a>
        
      </div>  
  </div>
 	<div style="width:85%; float:right;">

 	<div class="card">
 	 <div class="card-block">
  	{{--<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Peticiones a Club Activo 20-30</h6>
        --}}

 		<div class="row" >
 		{{--<div class="col-6" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; ">Beneficiarios de Club Activo 20-30 </label>	
     	</div>--}}
      <div class="col-6">
        <h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Listado de Peticiones a Club Activo 20-30</h6>
        
        <label style="text-align:left; font-size:18px; "></label>  
      </div>
     	<div class="form-group row col-6 ">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>
  	  </div>
 
     
<div class="row" id="tabla">
{{--<div id="tabla"></div>finn id tabla --}}

		@forelse($peticiones as $peticion)
    <div class="col-12">
<div class="card  card-outline- " style="margin-top:5px; {{--max-height: 20rem;--}} {{--@if($peticion->id==8)display:none;@endif--}}">
  <div class="card-block">
    <h6 class="card-title">{{ $peticion->titulo }}</h6>
    <hr>
      <div style="width:85%; float:left; padding-right:0px;" >
         <p class="card-text" style="font-size:13px">{{ $peticion->descripcion }}</p>
    <div class="card-text text-muted float-left" style="font-size:14px">
     
     <small class="text-muted"> {{ $peticion->created_at}}</small>
   
      </div>

      </div>
       <div style="width:10%; float:left; padding-right:0px;" >
      <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm peticionModal" value="{{ $peticion->id }}">Crear Proyecto</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-info btn-sm infomodal" value="{{ $peticion->id }}">+Info</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-danger btn-sm editModal" value="{{ $peticion->id }}">Eliminar</button>
      
      </div>
    </div>
  
<div class="card-footer" {{--style="background-color: #fBfBfB"--}}>  
    <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm peticionModal" value="{{ $peticion->id }}">Crear Proyecto</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-info btn-sm infomodal" value="{{ $peticion->id }}">+Info</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-danger btn-sm editModal" value="{{ $peticion->id }}">Eliminar</button>
      
</div> 

</div>{{-- fin card--}}  

</div> {{--fin col--}}   
		@empty
    	<p>No hay Peticiones</p>
  		@endforelse
       

</div>
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
            @include('solicitantes.formSoli')
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
<!-- Modal con tabindex -1 no funciona select2-->
<div class="modal fade" id="Modal3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog {{--modal-lg--}} " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Crear Peticion</h5>
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
        <button type="button" class="btn btn-primary" id="btnsave2" value="Anhadir">Save changes</button>
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
