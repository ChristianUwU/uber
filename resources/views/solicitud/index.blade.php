@extends('layouts.app')

@section('contenido')
<h3 class="col-span-3 font-bold text-2xl p-3">
    Solicitudes
</h3>

<div class="grid p-2 text-center">
    <div class="grid-cols-12">
        <form action="{{ route('solicitud.index') }}" method="GET">
            <input type="text" class="w-1/2 mr-5 rounded-lg border-stone-900" name="texto" value="" placeholder="Buscar">
            <div class="inline p-2 bg-cyan-500  hover:bg-cyan-400 font-bold rounded-md text-lg">
                <input type="submit" class="pr-2" value="Buscar">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
            </div>
        </form>
    </div>
</div>

<div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="font-bold text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nro 
                </th>
                <th scope="col" class="py-3 px-6">
                    Nombre 
                </th>
                <th scope="col" class="py-3 px-6">
                    Apellido
                </th>
                <th scope="col" class="py-3 px-6">
                    Carnet 
                </th>
                <th scope="col" class="py-3 px-6">
                    Telefono
                </th>
                <th scope="col" class="py-3 px-6 text-center">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
                @foreach ($solicituds as $solicitud)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                    <td class="py-1 px-6">
                        {{ $solicitud->id }}
                    </td>
                    <td class="py-1 px-6">
                        {{ $solicitud->cliente->user->nombre }}
                    </td>
                    <td class="py-1 px-6">
                        {{ $solicitud->cliente->user->apellido }}
                    </td>
                    <td class="py-1 px-6">
                        {{ $solicitud->ci }}
                    </td>
                    <td class="py-1 px-6">
                        {{ $solicitud->cliente->user->telefono }}
                    </td>
                    <td class="py-3 px-1">
                        <div class="flex justify-center gap-2">
                            <div class="flex justify-center items-center">
                                <div class="col-span-1 bg-indigo-700 hover:bg-indigo-800 hover:font-bold text-white p-1 rounded-md ">
                                    <i class="fa-solid fa-plus pr-2"></i> <a href="{{ route('solicitud.show', $solicitud->id) }}">Mostrar</a>
                                </div>
                            </div>

                            <form action="{{ route('solicitud.accepted', $solicitud->id) }}" method="POST">
                                @csrf
                                <x-button-edit>
                                    Aceptar
                                </x-button-edit>
                            </form>

                            <form action="{{ route('solicitud.destroy', $solicitud->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button-delete>
                                    Rechazar
                                </x-button-delete>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach

                <div>
                {{$solicituds->links('pagination::tailwind')}}
                </div>
                
        </tbody>
    </table>
</div>
@endsection