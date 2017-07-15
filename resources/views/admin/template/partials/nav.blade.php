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
      <a class="navbar-brand" href="#">ORION</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
   @if(Auth::user())
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ route('admin.typeusers.index') }}">Tipo Usuario</a></li>
        <li class="active"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
        <li class="active"><a href="{{ route('admin.typesproperties.index') }}">Tipo de propiedad<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
        <li class="active"><a href="{{ route('admin.zones.index') }}">Zonas</a></li>
        <li class="active"><a href="{{ route('admin.states.index') }}">Estado de Inmuebles</a></li>
        <li class="active"><a href="{{ route('admin.ownerscurrents.index') }}">Propietarios</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Propiedades<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Listar todos</a></li>
            <li><a href="#">Listar por categorias</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Listar por tipo</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Listar por zonas</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('admin.auth.logout') }}">Salir</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
    @endif
  </div><!-- /.container-fluid -->
</nav>