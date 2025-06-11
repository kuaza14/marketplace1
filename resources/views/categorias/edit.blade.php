    @extends('layout')

    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">

     <style>
      .error{
        color: red;
        font-size: 0.875em;
      }

      .img-category{
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 8px;
      }
     </style>
    @stop
    
    @section('header')
    
      <div class="col">
        <h2 class="page-title">
          Editar Categoria
        </h2>
      </div>

      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="{{ url('categoria')}}" class="btn btn-primary d-none d-sm-inline-block" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              volver
            </a>
        </div>
      </div>

    @stop

@section('content')
<div>
  <form action="{{ route('categoria.update', $categoria->id) }}" method="POST" enctype="multipart/form-data" class="col-md-6">
            
    @csrf
    @method('PUT')

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoria" autofocus required value="{{ old('nombre', $categoria->nombre) }}">
              @error('nombre')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>            
            
            
                <div class=" mb-3">                  
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" placeholder="Slug de la categoria" readonly required value="{{ old('slug', $categoria->slug) }}">
                  @error('slug')
                    <div class="error">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  @if ($categoria->imagen)
                    <a href="{{ url('img/categorias/' . $categoria->imagen) }}" data-lightbox="{{$categoria->nombre }}" data-title="{{$categoria->nombre}}">
                      <img src="{{ url('img/categorias/' . $categoria->imagen) }}" class="img-category">  
                    </a>
                   @else
                      <a href="{{ url('img/categorias/avatar.png' . $categoria->imagen) }}" data-lightbox="{{$categoria->nombre}}" data-title="{{$categoria->nombre}}">
                       <img src="{{ url('img/categorias/avatar.png') }}" class="img-category">
                      </a>
                    
                    @endif
                  
                <div class="mb-3">
                    <label class="form-label">imagen</label>
                  <input type="file" class="form-control" name="imagen" accept="image/*">
                  
                </div>


              <div class="col-lg-12">
                <div class="mb-3">                  
                  <label class="form-label">Descripcion</label>
                  <textarea class="form-control" rows="3" name="descripcion"> {{ old('descripcion', $categoria->descripcion) }}</textarea>
                  @error('descripcion')
                  <div class="error">{{ $message }}</div>
                @enderror
                </div>

                
              </div>
            
            
          </div>

          <div class ="my-3">
            <a href="{{ url('categoria') }}" class="btn btn-link link-secondary" >
              Cancelar
            </a>
            <button class="btn btn-primary ms-auto" >
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>             
             Enviar
            </button>
          </div>
        </div>
  </form>
</div>
@stop

@section('scripts')
  <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script>
        document.getElementById("nombre").addEventListener("input", function (event) {
            // Aquí puedes agregar lógica adicional si es necesario
            const nombre = e.target.value;
            const slug = generateSlug(nombre);
            // Asignamos el slug generado al input slug
            document.getElementById("slug").value = slug;

    });

    // Evento que se dispara cada vez que escribes o borras algo en "nombre"
function generateSlug(text) {

     return text
        .toString()                     // Asegura que el texto es una cadena
        .toLowerCase()                       // Convierte a minúsculas
        .normalize("NFD")                    // Elimina tildes
        .replace(/[\u0300-\u036f]/g, "")    // Remueve diacríticos
        .replace(/\s+/g, "-")               // Reemplaza espacios por guiones
        .replace(/[^a-zA-Z0-9\s]/g, "")    // Quita caracteres especiales
        .replace(/-+/g, "-")                // Quita guiones repetidos
        .replace(/^-+|-+$/g, "");           // Quita guiones al inicio y al final
        .replace(/^-+/,'')               // Quita guiones al inicio
        .replace(/-+$/,'')               // Quita guiones al final
        .replace(/-+/g, "-");                // Quita guiones repetidos

      // Asignamos el slug generado al input slug
    }
    </script>

    @stop