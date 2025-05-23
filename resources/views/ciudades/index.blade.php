    @extends('layout')
    
    @section('content')
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->estado }}</td>
            </tr>
            @endforeach

    </table>
    @stop

