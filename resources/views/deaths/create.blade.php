@extends('app')
@section('content')
  <death-component 
    :female="{{ $id }}" 
    :females="{{ $females }}" 
  >
  </death-component>
@endsection