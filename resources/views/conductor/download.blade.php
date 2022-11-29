<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
    </style>
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Lista de Conductores</title>
    
</head>

<body>
    <div class="invoice-box">
        <p class="text-center">
            Reporte Lista de Conductores - {{date('Y-m-d')}}
        </p>
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">Usuario cliente</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-left">CI</th>
                    {{-- <th class="text-left">Foto</th> --}}
                    <th class="text-left">Fecha creación</th>
                    <th class="text-left">Última actualización</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($conductors as $conductor)
                <tr>
                    <td>{{ $conductor->id }}</td>
                    <td>{{ $conductor->cliente_id }}</td>
                    <td>{{ $conductor->cliente->user->nombre }}</td>
                    <td>{{ $conductor->ci }}</td>
                    {{-- <td>
                        <img src="{{asset('storage'.'/'.$conductor->foto)}}" alt="" height="100" width="100">
                    </td> --}}
                    <td>{{ $conductor->created_at }}</td>
                    <td>{{ $conductor->updated_at }}</td>
                </tr>
                @empty

                @endforelse
            </tbody>
            
        </table>
    </div>
</body>

</html>