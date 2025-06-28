@extends('layout')


@section('styles')
<link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
<style>
    .error {
        color: red;
        font-size: 0.875em;
    }

    .img-category {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50px;
        box-shadow: 0 0 8px;
        padding: 2px;
    }

    .card {
        background-color: rgb(223, 239, 255);
        margin: 20px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@stop

@section('title')
<h2 class="page-title">
    Editar Produto
</h2>

<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ url('producto') }}" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left-dashed">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12h6m3 0h1.5m3 0h.5" />
                <path d="M5 12l6 6" />
                <path d="M5 12l6 -6" />
            </svg>
            Volver
        </a>
    </div>
</div>
@stop


@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $producto->id }}">

            {{-- Imagen centrada --}}
            <div class="row justify-content-center mb-4">
                <div class="col-auto text-center">
                    @if ($producto->imagen)
                    <a href="{{ url('img/productos/' . $producto->imagen) }}" data-lightbox="{{ $producto->nombre }}" data-title="{{ $producto->nombre }}">
                        <img src="{{ url('img/productos/' . $producto->imagen) }}" class="img-category" alt="Imagen de producto">
                    </a>
                    @else
                    <a href="{{ url('img/productos/avatar.png') }}" data-lightbox="{{ $producto->nombre }}" data-title="{{ $producto->nombre }}">
                        <img src="{{ url('img/productos/avatar.png') }}" class="img-category" alt="Imagen por defecto">
                    </a>
                    @endif

                    <div class="mt-2">
                        <label class="form-label">Cambiar imagen</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre del producto" autofocus required value="{{ old('nombre', $producto->nombre) }}">
                    @error('nombre')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" placeholder="Slug del producto" readonly required value="{{ old('slug', $producto->slug) }}">
                    @error('slug')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" placeholder="Valor del producto" autofocus required value="{{ old('valor', $producto->valor) }}">
                    @error('valor')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="estado_producto" class="form-label">Estado del producto</label>
                    <select class="form-select" name="estado_producto" id="estado_producto" required>
                        <option value="">-- Selecciona una opción --</option>
                        <option value="nuevo" {{ old('estado_producto', $producto->estado_producto) == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                        <option value="poco uso" {{ old('estado_producto', $producto->estado_producto) == 'poco uso' ? 'selected' : '' }}>Poco uso</option>
                        <option value="usado" {{ old('estado_producto', $producto->estado_producto) == 'usado' ? 'selected' : '' }}>Usado</option>
                    </select>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" rows="3" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

    </div>

    <div class="row gx-3 mb-4"> <!-- gx-3 = separación horizontal, mb-4 = margen inferior -->

        <div class="col-lg-4">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">-- Selecciona una categoria --</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id' , $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4">
            <label class="form-label">usuario</label>
            <select name="usuario_id" class="form-control" required>
                <option value="">-- Selecciona una usuario --</option>
                @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('usuario_id' , $producto->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4">
            <label class="form-label">Ciudad</label>
            <select name="ciudad_id" class="form-control" required>
                <option value="">-- Selecciona una ciudad --</option>
                @foreach ($ciudades as $ciudad)
                <option value="{{ $ciudad->id }}" {{ old('ciudad_id' , $producto->ciudad_id ?? '') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>



<div class="mt-3">
    <a href="{{ url('producto') }}" class="btn btn-link link-secondary">
        Cancelar
    </a>
    <button class="btn btn-primary ms-auto">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 14l11 -11" />
            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
        </svg>
        Actualizar
    </button>
</div>
</div>
</div>
</div>

</form>

</div>
</div>
@stop



@section('scripts')
<script src="{{ url('js/lightbox.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nombreInput = document.querySelector('input[name="nombre"]');
        const slugInput = document.querySelector('input[name="slug"]');

        // Evento que se dispara cada vez que escribes o borras algo en "nombre"
        nombreInput.addEventListener("input", function() {
            let valor = nombreInput.value;

            // Convertimos a slug:
            let slug = valor
                .toLowerCase()
                .normalize("NFD") // Elimina tildes
                .replace(/[\u0300-\u036f]/g, "") // Remueve diacríticos
                .replace(/[^a-z0-9\s-]/g, "") // Quita caracteres especiales
                .trim()
                .replace(/\s+/g, "-") // Reemplaza espacios por guiones
                .replace(/-+/g, "-"); // Quita guiones repetidos

            // Asignamos el slug generado al input slug
            slugInput.value = slug;
        });
    });
</script>

@stop