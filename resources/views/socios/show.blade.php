@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	<ul class="nav nav-tabs">
		<li class="nav-item  active">
			<a class="nav-link active" href="/pagos/pagoAnho">{{$tipoSocio}}</a>
		<li>
	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>
 <div style="width:14%; float:left; padding-right:0px;" id="menu-vertical-pagos">
<div style="clear:both; padding-bottom:35px;">
  </div>
			{{--<div class="list-group" style="padding-bottom:25px;">
			<a href="/pagos/index/" class="list-group-item active">Carreras</a>
	 		<a href="/pagos/index/1092" class="list-group-item">Ingeniería de Sistemas Informáticos</a>
	 	</div>--}}
		<div class="list-group " class="padding-bottom:25px;">
			<li href="/pagos/index/" class="list-group-item active">Tipo de Socio{{--A&ntilde;os--}}</li>
				

				<div><a href="/socios/1" class="list-group-item list-group-item-action justify-content-between">Socio Activo<span class="badge badge-default badge-pill">{{$count0}}</span></a></div>
				<a href="/socios/2" id="activoMayor" class="list-group-item justify-content-between">Activo Mayor <span class="badge badge-default badge-pill">{{$count}}</span></a>
				{{--<a href="/pagos/pagoAnho/2015/1092/grado" class="list-group-item justify-content-between">Inactivos<span class="badge badge-default badge-pill">{{$count}}</span></a>
				--}}
			</div>	
	</div>
	
 	<div style="width:85%; float:right;" id="contenido-pagos">
 <div class="card">
  <div class="card-block">
  {{--	<h4 class="card-title">Socios de Club Activo 20-30</h4>
  	--}}<h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Socios de Activo 20-30</h6>
            					
	{{--<div class="row" >
		<div class="col-8 offset-3">
			<label for="example-text-input" style="text-align:left; font-weight:bold; font-size:20px; " ><i>Beneficiarios de Club Activo 20-30</i></label>
     	</div>
 	 	
	</div>--}}
 		<div class="row" >
 		<div class="col-2" style="clear:both; padding-top:15px;">
  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
			Nuevo</button>	
     	</div>
     	<div class="col-4">
  			<label style="text-align:left; font-weight:bold; font-size:20px; "> </label>	
     	</div>
     	<div class="form-group row col-6">
 	 <label for="example-text-input"  class="col-1 col-form-label offset-1"> Buscar </label>
  			<div class="col-9 offset-1 ">
      				<input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
  				</div>
  	  
		</div>
  	  </div>

 	<table class="table {{--table-bordered--}} table-hover table-sm  " align="center">
	<thead >
	        <tr>
	  {{--          <th colspan="4" style="text-align:center; font-weight:bold; letter-spacing:5px;"><label >{{strtoupper($tipoSocio)}}</label> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
	            	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
					  Launch demo modal
					</button>	
	            </th>
	      --}}  
	        </tr>
	</thead>
	<thead >
	        <tr >
	        	<th style="text-align: center">Apodo</th>
	           	
	            <th class="center ">Nombre</th>
	           {{--	<th class="center ">Apellido</th>
	           	
	           	<th>A&ntilde;o</th>--}}
	           	<th>Email</th>
	           	{{--<th style="text-align: center">Tipo</th>
	           	--}}<th class="center ">Cargo</th>
	           	<th style="text-align: center">Estado</th>
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($socios as $socio)
		<tr id="{{ $socio->id }}">
			<td style="padding:6px">{{ $socio->apodo }}</td>
			<td>{{ $socio->nombre }} {{ $socio->apellido }}</td>
			{{--<td>2017</td>
			<td >{{ $socio->apellido }}</td>--}}
			<td>{{ $socio->email }}</td>
			{{--<td class="text-center">{{ $socio->tipoSocio }}</td>
			--}}<td >{{ $socio->cargo }}</td>
			<td class="text-center">
				@if($socio->tipoSocio=='Socio Activo')
				<button type="button" class="btn btn-outline-warning btn-sm " value="{{ $socio->id }}">Pagos</button>
				@endif
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $socio->id }}">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $socio->id }}">Editar</button>
				<button type="button" class="btn btn-outline-danger btn-sm" value="{{ $socio->id }}">Dar Baja</button>
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($socios))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $socios->links('
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
                            <button type="button" class="btn btn-primary" id="btn-saveiuy" value="add" data-toggle="modal" data-target="#exampleModal">Save changes</button>
                           
                        </div>
                    </div>
                </div>
       </div>
   </div>
{{-- //////////////FIN MODLA--}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            @include('socios.form')
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
  <script src="{{asset('js/socios.js')}}"></script>

@endsection
