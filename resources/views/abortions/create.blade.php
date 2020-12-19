@extends('app')
@section('content')
  <abortion-component 
    :female="{{ $id }}" 
    :females="{{ $females }}" 
  >
  </abortion-component>
@endsection