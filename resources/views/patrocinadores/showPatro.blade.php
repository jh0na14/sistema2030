@extends('layouts.app')
@section('content')	
	<div class="row" style="padding-bottom:10px;">
		
	</div>
    
	
	<ul class="nav nav-tabs">
		<li class="nav-item  active">
			<a class="nav-link active">Patrocinadores</a>
		<li>
	</ul>

  <div style="clear:both; padding-bottom:15px;">
  </div>

 	<div style="width:100%; float:right;">

 	<table class="table {{--table-bordered--}} table-hover table-sm  " align="center">
	<thead >
	        <tr>
	            <th colspan="3" style="text-align:center; font-weight:bold; letter-spacing:5px;">DE CLUB ACTIVO 20-30</th>
	            <th colspan="2" style="text-align:right; font-weight:bold; letter-spacing:5px;">
	            	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
					  Nuevo Patrocinador
					</button>	
	            </th>
	        
	        </tr>
	</thead>
	<thead >
	        <tr >
	        	{{--<th class="center ">ID</th>--}}
	        	<th style="text-align: center">Nombre</th>
	           	<th class="center ">Descripcion</th>
	           <th style="text-align: center">Estado</th>
	           
	        </tr>
	</thead>
	<tbody id="tabla" name="tabla">
		@forelse($patrocinadores as $patrocinador)
		{{--<tr id="{{ $patrocinador->id }}">--}}

			{{--<td>{{ $patrocinador->id }}</td>--}}
			<td>{{ $patrocinador->nombre }}</td>
			<td >{{ $patrocinador->descripcion }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $patrocinador->id }}">Info</button>
				<button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $patrocinador->id }}">Editar</button>
			</td>

        </tr>
		@empty
    	<p>No hay mensajes destacados</p>
  		@endforelse
		        
		</tbody>


	</table>
{{--@if(count($patrocinador))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $patrocinadores->links('pagination::bootstrap-4') }}
  </div>


{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal" stabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Datos Patrocinador</h4>
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
            @include('patrocinadores.formPatro')
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
  <script src="{{asset('js/patrocinador.js')}}"></script>


@endsection
