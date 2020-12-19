@extends('app')
@section('content')
  <abortion-component 
    :female="{{ $id }}"
    :abortion="{{ $data['abortion'] }}"  
    :females="{{ $data['females'] }}" 
  >
  </abortion-component>
@endsection