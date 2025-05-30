    @extends('layout')
    
    @section('content')
    <h2 class="page-title">
                  Productos
                </h2>
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Descripcion</th>
                <th>Valor</th>
                <th>Imagen</th>
                <th>Estado_producto</th>
                <th>Estado</th>
                <th>Categoria_id</th>
                <th>Usuario_id</th>
                <th>Ciudad_id</th>

            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->slug }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->valor }}</td>
                <td>{{ $categoria->imagen }}</td>
                <td>{{ $categoria->estado_producto }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>{{ $categoria->categoria_id }}</td>
                <td>{{ $categoria->usuario_id }}</td>
                <td>{{ $categoria->ciudad_id }}</td>
                
                
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

    @section('modal')
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true" >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="{{ url('producto') }}" method="POST" enctype="multipart/form-data">
              @csrf

            


            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre del producto" autofocus>
            </div>            
            
            <div class="row">
                <div class="col-lg-6 mb-3">                  
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" placeholder="Slug del producto" readonly>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label">imagen</label>
                  <input type="file" class="form-control" name="imagen" placeholder="Imagen del producto" accept="image/*">
                </div>
                
            <div class="row">            
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" placeholder="Valor del producto" autofocus>
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="estado_producto" class="form-label">Estado del producto</label>
                    <select class="form-select" name="estado_producto" id="estado_producto" required>
                    <option value="">-- Selecciona una opción --</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="poco uso">Poco uso</option>
                    <option value="usado">Usado</option>
                    </select>
                </div>
            </div>

                
              <div class="col-lg-12">
                <div class="mb-3">                  
                  <label class="form-label">Descripcion</label>
                  <textarea class="form-control" rows="3" name="descripcion"></textarea>
                </div>
              </div>
            </div>
            </form>
          </div>

          <div class="row gx-3 mb-4"> <!-- gx-3 = separación horizontal, mb-4 = margen inferior -->
           
            <div class="col-lg-4">
                <label class="form-label">Categoria</label>
                <input type="text" pattern="\d+" inputmode="numeric" class="form-control" name="categoria_id" placeholder="ID de la categoria" required>
            </div>

            <div class="col-lg-4">
                <label class="form-label">Usuario</label>
                <input type="text" pattern="\d+" inputmode="numeric" class="form-control" name="usuario_id" placeholder="ID del usuario" required>
            </div>

            <div class="col-lg-4">
                <label class="form-label">Ciudad</label>
                <input type="text" pattern="\d+" inputmode="numeric" class="form-control" name="ciudad_id" placeholder="ID de la ciudad" required>
            </div>



          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancelar
            </a>
            <a href="#" class="btn btn-primary ms-auto" id="btn-submit" onclick="document.querySelector('form').submit();">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>             
             Enviar
            </a>
          </div>
        </div>
      </div>
    </div>
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