<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Expediente en Línea | Expediente en Línea :: Pagos</title>
        {{-- link de boostrap 4--}}
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
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
        margin-right:0%; 
        max-width: 100%;*/
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
        <a class="nav-link" href="#">Socios <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Peticiones</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
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
    @yield('script') 
   


    </body>
  
</html>