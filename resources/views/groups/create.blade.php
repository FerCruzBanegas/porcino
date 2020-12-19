@extends('app')
@section('content')
  <div class="cardbox">
    <div class="cardbox-body">
      <div class="cardbox-heading">
        <div class="cardbox-title">Registrar Grupo</div>
        <small>Los campos con (*) son obligatorios.</small>
      </div>
      <div class="row"> 
        <div class="col-md-12">    
          <group-form :females="{{$females}}"></group-form>
        </div>
      </div>
    </div>
  </div>
@endsection