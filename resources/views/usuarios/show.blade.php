@extends('layout')

@section('title')
<h2 class="page-title">Detalles del Usuario</h2>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-md-4 text-center">
        @if ($usuario->imagen)
        <img src="{{ url('img/usuarios/' . $usuario->imagen) }}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="Imagen de {{ $usuario->nombre }}">
        @else
        <img src="{{ url('img/usuarios/avatar.png') }}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="Avatar por defecto">
        @endif
      </div>
      <div class="col-md-8">
        <h3 class="mb-3">{{ $usuario->nombre }}</h3>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>Teléfono:</strong> {{ $usuario->movil }}</p>
        <p><strong>Rol:</strong> {{ ucfirst($usuario->rol) }}</p>
        <p><strong>Ciudad:</strong> {{ $usuario->ciudad->nombre ?? '' }}</p>
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <a href="{{ route('usuario.index') }}" class="btn btn-secondary">← Volver a la lista</a>
      <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-primary ms-2">Editar</a>
    </div>
  </div>
</div>
@endsection
