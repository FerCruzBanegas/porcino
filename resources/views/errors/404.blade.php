@extends('app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="p-4 text-center">
          <p class="text-black text-bold text-xl lh1">404</p>
          <p class="lead">Página no encontrada</p>
          <p>Lo sentimos, la página a la que intenta acceder no existe, o no se encuentra disponible. 
            <a href="{{ URL::previous() }}">volver atrás </a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection