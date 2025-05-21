    @extends('layout')
    
    @section('content')
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

