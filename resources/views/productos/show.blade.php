@extends('layout')

@section('styles')
<link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
@stop

@section('title')
<h2 class="page-title">Detalle del Producto</h2>
@stop

@section('content')
<div class="card shadow-lg border-0 mb-4">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-4 text-center mb-4">
        @if ($producto->imagen)
          <a href="{{ url('img/productos/' . $producto->imagen) }}" data-lightbox="producto" data-title="{{ $producto->nombre }}">
            <img src="{{ url('img/productos/' . $producto->imagen) }}" class="rounded-circle shadow" width="200" height="200" style="object-fit: cover;">
          </a>
        @else
          <img src="{{ url('img/productos/avatar.png') }}" class="rounded-circle shadow" width="200" height="200" style="object-fit: cover;">
        @endif
      </div>
      <div class="col-md-8">
        <h3>{{ $producto->nombre }}</h3>
        <p><strong>Slug:</strong> {{ $producto->slug }}</p>
        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
        <p><strong>Valor:</strong> ${{ number_format($producto->valor, 0, ',', '.') }}</p>
        <p><strong>Estado del producto:</strong> {{ ucfirst($producto->estado_producto) }}</p>
        <p><strong>Estado:</strong>
          @if($producto->estado == 1)
            <span class="badge bg-success">Activo</span>
          @else
            <span class="badge bg-danger">Inactivo</span>
          @endif
        </p>
        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
        <p><strong>Usuario:</strong> {{ $producto->usuario->nombre ?? 'Sin usuario' }}</p>
        <p><strong>Ciudad:</strong> {{ $producto->ciudad->nombre ?? 'Sin ciudad' }}</p>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-end gap-2">
  <a href="{{ url('producto') }}" class="btn btn-secondary">
    ← Volver a la lista
  </a>
  <a href="{{ url('producto/' . $producto->id . '/edit') }}" class="btn btn-primary">
    ✎ Editar
  </a>
</div>
@stop

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('js/lightbox.min.js') }}"></script>
@stop

