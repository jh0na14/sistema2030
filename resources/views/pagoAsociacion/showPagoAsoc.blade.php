@extends('layouts.app')
@section('content') 
  <div class="row" style="padding-bottom:10px;">
    
  </div>
    s
  
  <ul class="nav nav-tabs">
    
      <li class="nav-item ">
      <a class="nav-link active " href="/pagoasoc">Pago Asociacion</a>
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
    <h6 class="card-subtitle mb-2 text-muted" style="font-weight:bold;">Pagos Hacia la Asociacion Nacional de Club Activo 20-30</h6>
         


     {{--<div class="row" >
    <div class="col-4 offset-4">
      <label for="example-text-input" style="text-align:left; font-weight:bold; font-size:20px; " ><i>Pagos hacia la Asociacion Nacional de Club Activo 20-30</i></label>
      </div>
    
  </div>--}}

    <div class="row" >
    <div class="col-6" style="clear:both; padding-top:15px;">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnnuevo">
      Nuevo</button>  
      </div>
      {{--<div class="col-4">
        <label style="text-align:left; font-weight:bold; font-size:20px; ">Pagos hacia la Asociacion Nacional de Club Activo 20-30 </label> 
      </div>--}}
      <div class="form-group row col-6">
   <label for="example-text-input"  class="col-1 col-form-label offset-1">Buscar</label>
        <div class="col-9 offset-1 ">
              <input class="form-control" placeholder="Buscar" type="text" id="search" name="search" autofocus>             
          </div>
      
    </div>
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
          <th style="text-align: center" style="text-color:#000000;">ID Periodo</th>
            <th style="text-align: center" style="text-color:#000000;">Monto </th>
              <th class="center ">Fecha de Abono</th>
             {{-- 
              
              <th>A&ntilde;o</th>--}}
              <th style="text-align: center">Estado</th>
          </tr>
  </thead>
  <tbody id="tabla" name="tabla">
    @forelse($pagoasoc as $pagoasoc)
    <tr id="{{ $pagoasoc->id }}">
      <td>{{ $pagoasoc->idPeriodo }}</td>
      <td>{{ $pagoasoc->monto }}</td>
      <td >{{ $pagoasoc->fecha }}</td>
      <td class="text-center">
        <button type="button" class="btn btn-outline-primary btn-sm peticionModal" value="{{ $pagoasoc->id }}">Crear </button>
        <button type="button" class="btn btn-outline-info btn-sm infomodal" value="{{ $pagoasoc->id }}">Info</button>
        <button type="button" class="btn btn-outline-success btn-sm editModal" value="{{ $pagoasoc->id }}">Editar</button>
      </td>

        </tr>
         
    @empty
      <p>No hay mensajes destacados</p>
      @endforelse
            
    </tbody>


  </table>
  
{{--@if(count($verdugos))@endif--}}
  <div class="mt-2 mx-auto">
  {{ $pagoasoc->links('
  pagination::bootstrap-4') }}
  </div>

////////aqui me quede
{{-- //////////////////////////MODAL FICHA--}}
<div class="modal fade" id="myModal" name="myModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="modal-title" id="myModalLabel">Datos de Pago</h4>
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
<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            @include('pagoAsociacion.formPagoAsoc')
        </div>
        </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close pagos Aso.</button>
        <button type="button" class="btn btn-primary" id="btnsave" value="Anhadir">Save changes</button>
      </div>
    </div>
  </div>
</div>  
{{-- /////////////////////FIN--}}
<!-- Modal --> 
<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            @include('pagoAsociacion.formPagoAsoc')
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsavepeticion" value="Anhadir">Save changes</button>
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
  <script src="{{asset('js/pagoAsoc.js')}}"></script>

@endsection
