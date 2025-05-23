    @extends('layout')
    
    @section('content')
    <table class="ui celled table">
        <trehead>
            <tr>
                <th>Nombre</th>
                <th>Movil</th>
                <th>Email</th>

            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->movil }}</td>
                <td>{{ $categoria->email }}</td>
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

