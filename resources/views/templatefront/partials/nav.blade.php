<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-fm">
        <span class="sr-only">Desplegar/Ocultar</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand titulonavbar">Orion Bienes Raices</a>
    </div>
    <!-- Inicio del Menu -->
    <div class="collapse navbar-collapse" id="navigation-fm">
      <ul class="nav navbar-nav">
        <li class="linavbar"><a href="{{ route('welcome') }}">Inicio <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
        <li class="linavbar"><a href="{{ route('search') }}">Busqueda <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
        <li class="linavbar"><a href="{{ route('sale') }}">Oferta <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li class="linavbar"><a href="{{ route('information') }}">Nosotros <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
        <li class="linavbar"><a href="{{ route('customers') }}">Contacto <span class="glyphicon glyphicon-phone" aria-hidden="true"></span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--  <li><a href="{{ route('admin.auth.login') }}">Login</a></li> -->
        <span class="fa-stack fa-lg">
          <i class="fa fa-square-o fa-stack-2x"></i>
          <i class="fa fa-facebook fa-stack-1x"></i>
        </span>
        <span class="fa-stack fa-lg">
          <i class="fa fa-square-o fa-stack-2x"></i>
          <i class="fa fa-twitter fa-stack-1x"></i>
        </span>
        <span class="fa-stack fa-lg">
          <i class="fa fa-square-o fa-stack-2x"></i>
          <i class="fa fa-envelope fa-stack-1x"></i>
        </span>
          <li><a href="{{ route('admin.auth.login') }}">Login</a></li>
      </ul>
    </div>
  </div>  
</nav>
