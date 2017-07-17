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

 	<div style="width:100%; float:right;">

 	<table class="table {{--table-bordered--}} table-hover table-sm  " align="center">
	<thead >
	        <tr>
	            <th colspan="4" style="text-align:center; font-weight:bold; letter-spacing:5px;"><label >{{strtoupper($tipoSocio)}}</label> DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:center; font-weight:bold; letter-spacing:5px;">
	            	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
					  Launch demo modal
					</button>	
	            </th>
	        
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
		@forelse($beneficiarios as $beneficiario)
		<tr id="{{ $beneficiario->id }}">
			<td style="padding:6px">{{ $socio->apodo }}</td>
			<td>{{ $beneficiario->nombre }} {{ $beneficiario->apellido }}</td>
			<td >{{ $socio->apellido }}</td>
			<td>{{ $socio->email }}</td>
			{{--<td class="text-center">{{ $socio->tipoSocio }}</td>
			--}}<td >{{ $socio->cargo }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm " value="{{ $beneficiario->id }}">Pagos</button>
				
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $beneficiario->id }}">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $beneficiario->id }}">Editar</button>
				<button type="button" class="btn btn-outline-danger btn-sm" value="{{ $beneficiario->id }}">Eliminar</button>
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
            					<table   class="table {{--table-bordered--}}  table-sm " align="center">
            					<tbody id="tablainfo">
            					</tbody>
            					</table>
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
	
  

	{{-- FIn style width 85% --}}</div>
	
	
	<div style="clear:both;"></div>
@endsection

@section('script')
  <script src="{{asset('js/socios.js')}}"></script>

@endsection
