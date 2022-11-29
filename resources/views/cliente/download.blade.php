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
    <title>Lista de Clientes</title>
    
</head>

<body>
    <div class="invoice-box">
        <p class="text-center">
            Reporte Lista de Clientes - {{date('Y-m-d')}}
        </p>
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-left" >Id</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Apellido</th>
                    <th class="text-left">Telefono</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->user->nombre }}</td>
                    <td>{{ $cliente->user->apellido }}</td>
                    <td>{{ $cliente->user->telefono }}</td>
                </tr>
                @empty

                @endforelse
            </tbody>
            
        </table>
    </div>
</body>

</html>
