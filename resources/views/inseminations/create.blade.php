@extends('app')
@section('content')
  <insemination-component 
    :female="{{ $id }}" 
    :females="{{ $data['females'] }}" 
    :semen="{{ $data['semen'] }}"
  >
  </insemination-component>
@endsection