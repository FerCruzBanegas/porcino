@extends('app')
@section('content')
  <death-component 
    :female="{{ $id }}"
    :death="{{ $data['death'] }}"  
    :females="{{ $data['females'] }}" 
  >
  </death-component>
@endsection