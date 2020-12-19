@extends('app')
@section('content')
  <insemination-component 
    :female="{{ $id }}" 
    :insemination="{{ $data['insemination'] }}" 
    :females="{{ $data['females'] }}" 
    :semen="{{ $data['semen'] }}"
  >
  </insemination-component>
@endsection