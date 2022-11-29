<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Cuenta cliente</th>
        <th>Nombre</th>
        <th>C.I.</th>
        <th>Foto</th>
        <th>Ocupado</th>
        <th>FOTO CI ANVERSO</th>
        <th>FOTO CI REVERSO</th>
        <th>FOTO ANTECEDENTE</th>
        <th>FOTO LICENCIA</th>
        <th>FOTO TIC</th>
        <th>Fecha creación</th>
        <th>Última actualización</th>
    </tr>
    </thead>
    <tbody>
    @foreach($conductors as $conductor)
        <tr>
            <td>{{ $conductor->id }}</td>
            <td>{{ $conductor->cliente_id }}</td>
            <td>{{ $conductor->cliente->user->nombre}}</td>
            <td>{{ $conductor->ci }}</td>
            <td>{{ $conductor->foto }}</td>
            <td>{{ $conductor->ocupado }}</td>
            <td>{{ $conductor->CI_Anverso }}</td>
            <td>{{ $conductor->CI_Reverso }}</td>
            <td>{{ $conductor->fotoAntecedente }}</td>
            <td>{{ $conductor->fotoLicencia }}</td>
            <td>{{ $conductor->fotoTIC }}</td>
            <td>{{ $conductor->created_at }}</td>
            <td>{{ $conductor->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>