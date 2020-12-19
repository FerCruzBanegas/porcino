@extends('app')
@section('content')
  <weaning-component 
    :female="{{ $id }}"
    :weaning="{{ $data['weaning'] }}"  
    :females="{{ $data['females'] }}" 
  >
  </weaning-component>
@endsection