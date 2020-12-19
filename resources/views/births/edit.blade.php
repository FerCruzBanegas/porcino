@extends('app')
@section('content')
  <abortion-component 
    :female="{{ $id }}"
    :birth="{{ $data['birth'] }}"  
    :females="{{ $data['females'] }}" 
  >
  </abortion-component>
@endsection