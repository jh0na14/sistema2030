<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Expediente en Línea | Expediente en Línea :: Pagos</title>
        {{-- link de boostrap 4--}}
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
         <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
    
    </head>
    <body>
<!-- Amplio el Alto al 90% -->
<style type="text/css">
    html, body {
        height: 100%;
        margin: 0px;
        font-size: 15px;
    }
    .container {
        min-height: 90%;
        height: auto !important;
        height: 100%;
        margin-left: 0 auto -90px;
       /* margin-left:4%;
        margin-right:0%; */
        max-width: 1920px !important;
        max-width: 100%;
    }
    table,th,td{
        padding: 0px;
        margin: 0px;
    }
    
    footer {
        height: 80px;
        width: 100%;
    }
    
    .push {
        height: 80px;
    }
    .modal .modal-body {
    max-height: 450px;
    overflow-y: auto;
   
}
//Estos 3 webkits es para cambiar el look de el scrooll
::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 10px;
    background-color: #F0F0F0;
}

::-webkit-scrollbar-thumb
{
    background-color: #FFFFFF;
    border: 2px solid #888FFF;
}
</style>

        <nav class="navbar navbar-toggleable-md {{--navbar-light bg-faded--}} navbar-inverse bg-danger" >
  <a class="navbar-brand" href="#">
    <img src="resources\assets\image\logopp.png" width="30" height="30" class="" alt="">
    <span >Club Activo 20-30</span>
  </a>
      <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/socios">Socios <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/peticiones">Peticiones</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/pagoasoc">Pago Asociacion</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/verdugo">Verdugo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Proyectos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Crear Proyectos de recaudacion</a>
          <a class="dropdown-item" href="/proyectos/2">Ver Proyectos</a>
          <a class="dropdown-item" href="/periodos">Periodos</a>
        </div>
      </li>
    
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tesoreria
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/sociospago">Membresias</a>
           <a class="dropdown-item" href="/sociospago">Pagos a Asociacion</a>
           <a class="dropdown-item" href="/verdugo">Verdugo</a>
           <a class="dropdown-item" href="/controlGastos">Gastos e Ingresos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Donaciones
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/donaciones">Donaciones realizadas y recibidas</a>
           <a class="dropdown-item" href="/patrocinador">Patrocinadores</a>
        </div>
      </li>
    </ul>

</nav>
<div class="container" >
     @yield('content') 
    

</div>
<div class="push"></div>
    
<div >
    <hr>
    <footer>
        <p style="padding-left:25px;">DTI &copy; Universidad de El Salvador 2017</p>
    </footer>
</div>

{{-- No se si me daba error esste token cuando lo utilizaba sin ajax--}}
<meta name="_token" content="{{ csrf_token() }}">
  <script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>  
    @yield('script') 
   


    </body>
  
</html>