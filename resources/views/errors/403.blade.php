@extends('app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="p-4 text-center">
          <p class="text-black text-bold text-xl lh1">403</p>
          <p class="lead">Acceso Denegado :(</p>
          <p>Lo sentimos, no tienes permiso para acceder a esta página. 
            <a href="{{ URL::previous() }}">volver atrás </a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection