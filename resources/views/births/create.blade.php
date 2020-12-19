@extends('app')
@section('content')
  <birth-component 
    :female="{{ $id }}" 
    :females="{{ $females }}" 
  >
  </birth-component>
@endsection