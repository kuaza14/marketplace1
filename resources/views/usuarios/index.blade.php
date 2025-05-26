    @extends('layout')
    
    @section('content')
    <h2 class="page-title">
                  Usuarios
                </h2>
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Movil</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Ciudad_id</th>

            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->movil }}</td>
                <td>{{ $categoria->email }}</td>
                <td>{{ $categoria->password }}</td>
                <td>{{ $categoria->rol }}</td>
                <td>{{ $categoria->ciudad_id }}</td>
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
            <h5 class="modal-title">Nuevo Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="{{ url('usuario') }}" method="POST" enctype="multipart/form-data">
              @csrf

            


            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario" autofocus>
            </div>        
            
            <div class="mb-3">
              <label class="form-label">Movil</label>
              <input type="text" class="form-control" name="movil" placeholder="Numero de Movil" autofocus>
            </div> 

            <div class="row">
                <div class="col-lg-6 mb-3">                  
                <label class="form-label">E-mail</label>
                <input type="text" class="form-control" name="email" placeholder="Email de usuario">
            </div>

                <div class="col-lg-6 mb-3">                  
                    <label class="form-label">password</label>
                    <input type="text" class="form-control" name="password" placeholder="password de usuario">
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 mb-3">                  
                <label class="form-label">Rol</label>
                <input type="text" class="form-control" name="rol" value="vendedor" readonly>
            </div>

                <div class="col-lg-6 mb-3">                  
                    <label class="form-label">ciudad_id</label>
                    <input type="text" class="form-control" name="ciudad_id" placeholder="ciudad_id de usuario">
                </div>
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


