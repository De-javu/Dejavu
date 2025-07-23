<div>
  <ul>
    @foreach($entidades as $entidad)
        <li>{{ $entidad->nombre }}</li>
    @endforeach
</ul>
</div>
