    @extends('layout')

    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">

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

    @if (session('success'))
    <div class="alert alert-{{ session('success') }}">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="page-title">
      Categorias
    </h2>

    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Url</th>                
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>
                  @if ($categoria->imagen)
                  <a href="{{ url('img/categorias/' . $categoria->imagen) }}" data-lightbox="{{$categoria->nombre }}" data-title="{{$categoria->nombre}}">
                    <img src="{{ url('img/categorias/' . $categoria->imagen) }}" class="img-category">  
                  </a>
                   @else
                   <a href="{{ url('img/categorias/avatar.png' . $categoria->imagen) }}" data-lightbox="{{$categoria->nombre}}" data-title="{{$categoria->nombre}}">
                    <img src="{{ url('img/categorias/avatar.png') }}" class="img-category">
                   </a>
                  @endif
                </td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->slug }}</td>
                <td>{{ $categoria->descripcion }}</td>

                <td>
                  @if($categoria->estado == 1)
                    <span class="badge bg-green text-white">Activo</span>
                  @else
                    <span class="badge bg-red">Inactivo</span>
                  @endif
                </td>
                <td>
                    <div class="btn-list flex-nowrap">
                        <a href="{{ url('categoria/' . $categoria->id . '/edit') }}" class="btn btn-primary">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20h9" /><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3l-10.5 10.5l-3 1l1 -3l10.5 -10.5z" /><path d="M19 6l-3 -3" /></svg>
                        </a>
                        <form action="{{ url('categoria/' . $categoria->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-default" title="Eliminar">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h16m-1 -4h-14a1 1 0 0 0 -1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1 -1v-14a1 1 0 0 0 -1 -1z" /><path d="M10.5 11v6m3 -6v6m-7 -8
m1 -4h10a1 1 0 0 1 1 1v1h-12v-1a1 1 0 0 1 1 -1z" /><path d="M9 7l.5 -2h5l.5 2" /></svg>
                            </button>
                        </form>
                    </div>
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
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script>
        document.getElementById("modal-report").addEventListener("show.bs.modal", function (event) {
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