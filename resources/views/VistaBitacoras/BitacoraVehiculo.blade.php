<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Lista de Vehiculos</title>
</head>

<body>
    {{-- <header class="headerr">
        <img src="{{ public_path('img/fotosPDF/Bugatti_W16_Mistral_2023_1.jpg') }}" width="750px" height="130px">
    </header> --}}
    <div class="invoice-box">
        {{-- invoice items --}}
        <p class="text-center">
            Bitacora de Vehiculos - {{date('d-m-Y')}}
        </p>
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-left">#</th>
                    <th class="text-left">Usuario</th>
                    <th class="text-left">Accion</th>
                    <th class="text-left">Fecha</th>
                    <th class="text-left">Hora</th>
                    <th class="text-left">IP-Cliente</th>
                    <th class="text-left">Vehiculo ID</th>
                    <th class="text-left">Placa</th>
                    <th class="text-left">Marca</th>
                    <th class="text-left">Modelo</th>
                    <th class="text-left">Anio</th>
                    <th class="text-left">Estado</th>
                    <th class="text-left">Conductor ID</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @forelse ($bitacora as $c)
                <tr class="item">
                    {{-- @dd($bitacora) --}}
                        <td class="text-center">{{ $c->id }}</td>
                        <td>{{$c->user}}</td>
                        <td class="text-center">{{$c->accion}}</td>
                        <td class="text-center">{{$c->fecha}}</td>
                        <td class="text-center">{{$c->hora}}</td>
                        <td class="text-center">{{$c->ip}}</td>
                        <td class="text-center">{{$c->vehiculo_id}}</td>
                        <td class="text-center">{{$c->placa}}</td>
                        <td class="text-center">{{$c->marca}}</td>
                        <td class="text-center">{{$c->modelo}}</td>
                        <td class="text-center">{{$c->anio}}</td>
                        <td class="text-center">{{$c->estado}}</td>
                        <td class="text-center">{{$c->id_conductor}}</td>
                </tr>
                @empty
                    <td>{{ $i + 1 }}</td>
                    <td>user</td>
                    <td>accion</td>
                    <td>fecha</td>
                    <td>hora</td>
                    <td>ip</td>
                    <td>vehiculo_id</td>
                    <td>Placa</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>2022</td>
                    <td>Estado</td>
                    <td>Propietario</td>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
