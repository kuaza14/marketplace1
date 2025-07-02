@extends('layout')


@section('styles')
<link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
<style>
    .error {
        color: red;
        font-size: 0.875em;
    }

    .img-category {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 80px;
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
    Editar usuario
</h2>

<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ url('usuario') }}" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
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

        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $usuario->id }}">

            {{-- Imagen centrada --}}
            <div class="row justify-content-center mb-4">
                <div class="col-auto text-center">
                    @if ($usuario->imagen)
                    <a href="{{ url('img/usuarios/' . $usuario->imagen) }}" data-lightbox="{{ $usuario->nombre }}" data-title="{{ $usuario->nombre }}">
                        <img src="{{ url('img/usuarios/' . $usuario->imagen) }}" class="img-category" alt="Imagen de usuario">
                    </a>
                    @else
                    <a href="{{ url('img/usuarios/avatar.png') }}" data-lightbox="{{ $usuario->nombre }}" data-title="{{ $usuario->nombre }}">
                        <img src="{{ url('img/usuarios/avatar.png') }}" class="img-category" alt="Imagen por defecto">
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
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre del usuario" required value="{{ old('nombre', $usuario->nombre) }}">
                    @error('nombre')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label">Rol</label>
                    <select class="form-control" name="rol" required>
                        <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="vendedor" {{ old('rol', $usuario->rol) == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    </select>
                    @error('rol')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                    

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Móvil</label>
                    <input type="text" class="form-control" name="movil" placeholder="Móvil del usuario" required value="{{ old('movil', $usuario->movil) }}">
                    @error('movil')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email del usuario" required value="{{ old('email', $usuario->email) }}">
                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password del usuario">
                    @error('password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label">Ciudad ID</label>
                    <input type="text" class="form-control" name="ciudad_id" placeholder="ID de la ciudad" required value="{{ old('ciudad_id', $usuario->ciudad_id) }}">
                    @error('ciudad_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ url('usuario') }}" class="btn btn-link link-secondary">
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
        </form>
    </div>
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


@stop