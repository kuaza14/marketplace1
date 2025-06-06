    @extends('layout')


    @section('styles')
     <style>
      .error{
        color: red;
        font-size: 0.875em;
      }

      .img-category{
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 50px;
        box-shadow: 0 0 8px;
      }
     </style>
    @stop

    @section('content')
    <h2 class="page-title">
                  Categorias
                </h2>
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>
                  @if ($categoria->imagen)
                  <img src="{{ url('img/categorias/' . $categoria->imagen) }}" class="img-category">  
                  @else
                  <img src="{{ url('img/categorias/avatar.png') }}" class="img-category">
                  @endif
                </td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

@section('modal')
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Nueva Categoria</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">

            <form action="{{ url('categoria') }}" method="POST" enctype="multipart/form-data">
              @csrf

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria" autofocus required value="{{ old('nombre') }}">
            @error('nombre')
              <div class="error">{{ $message }}</div>
            @enderror
            </div>            
            
            <div class="row">
                <div class="col-lg-6 mb-3">                  
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" placeholder="Slug de la categoria" readonly required value="{{ old('slug') }}">
                @error('slug')
                  <div class="error">{{ $message }}</div>
                @enderror
                </div>
                
                <div class="col-lg-6 mb-3">
                    <label class="form-label">imagen</label>
                  <input type="file" class="form-control" name="imagen" placeholder="Imagen de la categoria" accept="image/*">
                </div>


              <div class="col-lg-12">
                <div class="mb-3">                  
                  <label class="form-label">Descripcion</label>
                  <textarea class="form-control" rows="3" name="descripcion" value="{{ old('categoria') }}"></textarea>
                  @error('descripcion')
                  <div class="error">{{ $message }}</div>
                @enderror
                </div>
              </div>
            </div>
            
          </div>
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancelar
            </a>
            <button class="btn btn-primary ms-auto" >
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>             
             Enviar
            </button>
          </div>
        </div>
      </div>
      </div>
    </form>
    @stop

    @section('scripts')
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    const nombreInput = document.querySelector('input[name="nombre"]');
    const slugInput = document.querySelector('input[name="slug"]');

    // Evento que se dispara cada vez que escribes o borras algo en "nombre"
    nombreInput.addEventListener("input", function () {
      let valor = nombreInput.value;

      // Convertimos a slug:
      let slug = valor
        .toLowerCase()
        .normalize("NFD")                    // Elimina tildes
        .replace(/[\u0300-\u036f]/g, "")    // Remueve diacríticos
        .replace(/[^a-z0-9\s-]/g, "")       // Quita caracteres especiales
        .trim()
        .replace(/\s+/g, "-")                // Reemplaza espacios por guiones
        .replace(/-+/g, "-");                // Quita guiones repetidos

      // Asignamos el slug generado al input slug
      slugInput.value = slug;
        });
    });
    </script>

    @stop