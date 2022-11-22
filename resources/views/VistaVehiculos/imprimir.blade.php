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
            Reporte Lista de Vehiculos - {{date('Y-m-d')}}
        </p>
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-left">#</th>
                    <th class="text-left">PLACA</th>
                    <th class="text-left">MARCA</th>
                    <th class="text-left">MODELO</th>
                    <th class="text-left">AÑO</th>
                    <th class="text-left">ESTADO</th>
                    <th class="text-left">PROPIETARIO</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp
            @forelse ($cars as $c)
                <td>{{ $i + 1 }}</td>
                <td>{{$c->placa}}</td>
                <td>{{$c->marca}}</td>
                <td>{{$c->modelo}}</td>
                <td>{{$c->anio}}</td>
                <td>{{$c->estado}}</td>
                <td>{{$c->propietario}}</td>
            @empty
                <td>{{ $i + 1 }}</td>
                <td>Placa</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>2022</td>
                <td>Estado</td>
                <td>Propietario</td>
            @endforelse
        </table>
    </div>
</body>

</html>
