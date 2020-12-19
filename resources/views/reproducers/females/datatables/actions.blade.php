<div class="btn-group btn-group-sm" role="group" aria-label="Second group">
  <a href="{{route('inseminations.create', ['female' => $reproducer->id])}}" class="btn btn-outline-secondary"><i class="fa fa-medkit"></i></a>
  <a href="{{ url('females/'.$reproducer->id.'/edit') }}" class="btn btn-outline-secondary"><i class="fa fa-pencil"></i></a>
</div>