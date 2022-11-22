<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>

    </tr>
    </thead>
    <tbody>
    @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->user->nombre}}</td>
            <td>{{ $cliente->user->apellido}}</td>
            <td>{{ $cliente->user->telefono}}</td>

        </tr>
    @endforeach
    </tbody>
</table>