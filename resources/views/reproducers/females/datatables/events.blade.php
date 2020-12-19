<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Seleccionar
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('inseminations.create', ['female' => $reproducer->id])}}">Inseminación</a>
    <a class="dropdown-item" href="#">Parto</a>
    <a class="dropdown-item" href="{{route('weanings.create', ['female' => $reproducer->id])}}">Destete</a>
    <a class="dropdown-item" href="#">Baja</a>
  </div>
</div>