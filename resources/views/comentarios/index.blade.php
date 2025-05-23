    @extends('layout')
    
    @section('content')
    <table class="ui celled table">
        <trehead>
            <tr>
                
                <th>Descripcion</th>
                <th>Estado</th>
                <th>valoracion</th>
                
                

            </tr>
        </trehead>
        <tbody>
            @foreach ($data as $categoria)
            <tr>
                
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>{{ $categoria->valoracion }}</td>
                             
                
                <td>
                </td>
            </tr>
            @endforeach

    </table>
    @stop

