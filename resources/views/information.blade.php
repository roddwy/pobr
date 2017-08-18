@extends('templatefront.main')

@section('title','Nosotros')

@section('content')
<hr>
<div class="row rowtitulo">
    <div class="col-md-12">
        <h1 class="text-center tituloprincipal">ACERCA DE NOSOTROS</h1>
    </div>  
</div>
<div class="container marketing">
<!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Breve Historia de Orion Bienes Raices</h2>
          <p class="lead">Orión Bienes Raíces fue fundado un 20 de agosto del año 2014 con la idea de ayudar a las personas en la venta, alquiler y anticrético de inmuebles en la ciudad de La Paz.</p>
        </div>
        <div class="col-md-5">
          <img src="images/menu/imageorion.jpg" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Misión</h2>
          <p class="lead">Orientando a los propietarios sobre las diferentes alternativas en gestiones de venta, alquiler, o anticrético de sus inmuebles bajo un análisis transparente del mercado inmobiliario, mediante un trabajo selectivo y personalizado, comercializando al mejor precio y en el menor tiempo posible. Asesorar a los demandantes de inmuebles para tomar una decisión correcta acorde a las necesidades personales, con el deseo de mantener relaciones a largo plazo.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img src="images/menu/mision.jpg" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Visión</h2>
          <p class="lead">Posicionarnos como la empresa líder dentro el mercado inmobiliario de la ciudad de La Paz, marcando una clara diferencia en servicios especializados, dentro el mercado de Bienes Raíces. </p>
        </div>
        <div class="col-md-5">
          <img src="images/menu/vision.jpg" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">
</div>
@endsection