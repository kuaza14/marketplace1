    @extends('layout')
    
    @section('content')
    <h2 class="page-title">
                  Productos
                </h2>
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Valor</th>
                <th>Imagen</th>
                <th>Estado_producto</th>
                <th>Estado</th>

            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->valor }}</td>
                <td>{{ $categoria->imagen }}</td>
                <td>{{ $categoria->estado_producto }}</td>
                <td>{{ $categoria->estado }}</td>
                
                
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

