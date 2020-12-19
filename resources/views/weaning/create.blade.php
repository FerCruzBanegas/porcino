@extends('app')
@section('content')
  <weaning-component 
    :female="{{ $id }}" 
    :females="{{ $females }}" 
  >
  </weaning-component>
@endsection