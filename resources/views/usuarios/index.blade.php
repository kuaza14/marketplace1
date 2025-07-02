    @extends('layout')

    @section('styles')

    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

    <link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
    <style>
      .error {
        color: red;
        font-size: 0.875em;
      }

      .img-category {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 50px;
        box-shadow: 0 0 8px;
      }
    </style>
    @stop

    @section('title')
    <h2 class="page-title">
      Usuarios
    </h2>

    <div class="col-auto ms-auto d-print-none">
      <div class="btn-list">
        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
          </svg>
          Nuevo
        </a>
      </div>
    </div>
    @stop

    @section('content')
    @if(session('success'))
    <div class="alert alert-{{ session('type') }}">
      {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-{{ session('type') }}">
      {{ session('error') }}
    </div>
    @endif
    <div class="table-responsive">
      <table class="table tabla-personalizada">
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Movil</th>
            <th>Email</th>
            <!--<th>Contraseña</th>-->
            <th>Acciones</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($data as $usuario)
          <tr>
            <td>
              @if ($usuario->imagen)
              <a href="{{ url('img/usuarios/' . $usuario->imagen) }}" data-lightbox="{{ $usuario->nombre }}" data-title="{{ $usuario->nombre }}">
                <img src="{{ url('img/usuarios/' . $usuario->imagen) }}" class="img-category">
              </a>

              @else
              <a href="{{ url('img/usuarios/avatar.png') }}" data-lightbox="{{ $usuario->nombre }}" data-title="{{ $usuario->nombre }}">
                <img src="{{ url('img/usuarios/avatar.png') }}" class="img-category">
              </a>
              @endif
            </td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->movil }}</td>
            <td>{{ $usuario->email }}</td>
            <!--<td>{{ $usuario->password }}</td>-->
            <td>
              <div class="d-flex gap-1">
                <a href="{{ url('usuario/'.$usuario->id.'/edit') }}" class="btn btn-default" title="Editar">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                  </svg>
                </a>

                <a href="{{ route('usuario.show', $usuario->id) }}" class="btn btn-info" title="Ver">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-eye">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-4,0a4,4 0 1,0 8,0a4,4 0 1,0 -8,0" />
                    <path d="M3 12c2.5 -5 7 -8 9 -8s6.5 3 9 8c-2.5 5 -7 8 -9 8s-6.5 -3 -9 -8" />
                  </svg>
                </a>

                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" title="Eliminar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash-off">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M3 3l18 18" />
                      <path d="M4 7h3m4 0h9" />
                      <path d="M10 11l0 6" />
                      <path d="M14 14l0 3" />
                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" />
                      <path d="M18.384 14.373l.616 -7.373" />
                      <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                  </button>
                </form>
              </div>
            </td>

          </tr>
          @endforeach

      </table>
    </div>
    @stop

    @section('modal')
    <form action="{{ url('usuario') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario" autofocus required value="{{ old('nombre') }}">
                @error('nombre')
                <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Movil</label>
                <input type="text" class="form-control" name="movil" placeholder="Numero de Movil" autofocus required value="{{ old('movil') }}">
                @error('movil')
                <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-6 mb-3">
                <label class="form-label">imagen</label>
                <input type="file" class="form-control" name="imagen" placeholder="Imagen del producto" accept="image/*">
                @error('imagen')
                <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label class="form-label">E-mail</label>
                  <input type="text" class="form-control" name="email" placeholder="Email de usuario" required value="{{ old('email') }}">
                  @error('email')
                  <div class="error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-lg-6 mb-3">
                  <label class="form-label">password</label>
                  <input type="text" class="form-control" name="password" placeholder="password de usuario">
                  @error('password')
                  <div class="error">{{ $message }}</div>
                  @enderror
                </div>
              </div>


              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label class="form-label">Rol</label>
                  <select class="form-control" name="rol" required>
                    <option value="vendedor" {{ old('rol') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                  </select>
                  @error('rol')
                  <div class="error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-lg-6 mb-3">
                  <label class="form-label">Ciudad</label>
                  <input type="text" class="form-control" name="ciudad_id" placeholder="ID de la ciudad" required value="{{ old('ciudad_id') }}">
                  @error('ciudad_id')
                  <div class="error">{{ $message }}</div>
                  @enderror
                </div>
              </div>



              <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                  Cancelar
                </a>
                <button class="btn btn-primary ms-auto">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 14l11 -11" />
                    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                  </svg>
                  Enviar
                </button>
              </div>
            </div>
          </div>
        </div>
    </form>



    @stop

    @section('scripts')

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.table').DataTable({
          "language": {
            "url": "https://cdn.datatables.net/plug-ins/2.3.2/i18n/es-ES.json"
          },
          "order": [
            [1, "asc"]
          ] // Ordenar por la primera columna (nombre)
        });
      });
    </script>

    @if($errors->any())
    <script>
      $(document).ready(function() {
        $('#modal-report').modal('show');
      });
    </script>
    @endif

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