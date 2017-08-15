<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><strong>ORION BIENES RAICES</strong></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
   @if(Auth::user())
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      @if(Auth::user()->type_user->name == 'Administrador')
        <li><a href="{{ route('admin.typeusers.index') }}">Tipo Usuario</a></li>
        <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
        <li><a href="{{ route('admin.typesproperties.index') }}">Tipo de propiedad<span class="sr-only">(current)</span></a></li>
        <li><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
        <li><a href="{{ route('admin.zones.index') }}">Zonas y Asignaciones</a></li>
        <li><a href="{{ route('admin.states.index') }}">Estado de Inmuebles</a></li>
        <li><a href="{{ route('admin.reports') }}">Reportes</a></li>
        <li><a href="{{ route('admin.sms')}}">Sms</a></li>
      @endif
        <li><a href="{{ route('admin.ownerscurrents.index') }}">Propietarios</a></li>
        <li><a href="{{ route('admin.properties.index') }}">Inmuebles</a></li>        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}<span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('admin.auth.logout') }}">Salir</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
    @endif
  </div><!-- /.container-fluid -->
</nav>