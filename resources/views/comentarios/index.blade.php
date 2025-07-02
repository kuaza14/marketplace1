    @extends('layout')


    @section('styles')

    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

    <link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">

    <style>
      .error {
        color: red;
        font-size: 0.875em;
      }    
      .star-rating {
        direction: rtl;
        unicode-bidi: bidi-override;
      }

      .star-rating input[type="radio"] {
        display: none;
      }

      .star-rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        padding: 0 3px;
        transition: color 0.2s;
      }

      .star-rating input[type="radio"]:checked~label,
      .star-rating label:hover,
      .star-rating label:hover~label {
        color: gold;
      }
    </style>
    @stop

    @section('title')
    <h2 class="page-title">
      Comentarios
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

          <th>Descripcion</th>
          <th>Estado</th>
          <th>valoracion</th>
          <th>Acciones</th>



        </tr>
      </thead>
      <tbody>
        @foreach ($data as $comentario)
        <tr>

          <td>{{ $comentario->descripcion }}</td>
          <td>
            @if($comentario->estado == 1)
            <span class="badge bg-green text-white">Activo</span>
            @else
            <span class="badge bg-red text-white">Inactivo</span>
            @endif
          </td>

          <td>
            @for ($i = 1; $i <= 5; $i++)
              @if($i <=$comentario->valoracion)
              <span style="color: gold;">&#9733;</span>
              @else
              <span style="color: #ccc;">&#9733;</span>
              @endif
              @endfor
          </td>

          <td>
            <div>
              <a href="{{ url('comentario/'.$comentario->id.'/edit') }}" class="btn btn-default" title="Editar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                  <path d="M16 5l3 3" />
                </svg>
              </a>
              <form action="{{ route('comentario.destroy', $comentario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta comentario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
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
    <form action="{{ url('comentario') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @section('modal')
      <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Comentario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" rows="3" name="descripcion" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-control" name="estado" required>
                    <option value="">Seleccione estado</option>
                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                  </select>
                  @error('estado')
                  <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-lg-6 mb-3">
                  <label class="form-label">Valoración</label>
                  <div class="star-rating d-flex flex-row-reverse justify-content-start">
                    @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="valoracion{{ $i }}" name="valoracion" value="{{ $i }}" {{ old('valoracion') == $i ? 'checked' : '' }}>
                    <label for="valoracion{{ $i }}">&#9733;</label>
                    @endfor
                  </div>
                  @error('valoracion')
                  <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>


              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label class="form-label">Producto</label>
                  <input type="text" class="form-control" name="producto_id" placeholder="ID del producto" required value="{{ old('producto_id') }}">
                  @error('producto_id')
                  <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-lg-6 mb-3">
                  <label class="form-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario_id" placeholder="ID del usuario" required value="{{ old('usuario_id') }}">
                  @error('usuario_id')
                  <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>


              <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-send">
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
    @stop