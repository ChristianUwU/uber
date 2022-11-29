@extends('layouts.app')

@section('contenido')
    <h3 class="text-center font-bold text-2xl pt-3">
        Clientes Registrados
    </h3>

    {{-- Boton de PDF --}}
    {{-- <div class="relative w-full max-w-full flex pb-2 flex-1 text-right">
        <a href="{{ Route('download-pdf') }}" target="_blank"
            class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Imprimir
            PDF
        </a>

        <a href="{{ Route('repo-cliente-xlsx') }}" target="_blank"
            class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Imprimir
            EXCEL
        </a>

        <a href="{{ Route('repo-cliente-html') }}" target="_blank"
            class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Imprimir
            HTML
        </a>
    </div> --}}

<div class="flex items-center p-2">
    {{-- Julico --}}
    <form action="{{Route('repo-cliente')}}" id="form" class="hidden lg:block" method="POST">
        @csrf
        @method('POST')
        <div class="flex mx-1">
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1 mx-1">
                <label for="fecha_antes"> Creado Desde</label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date" min="2000-01-01" max="{{ date('Y-m-d H:i:s') }}" name="fecha_antes"
                    value="{{ $fecha_antes }}">
            </div>
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1 mx-1">
                <label for="fecha_hasta"> Creado Hasta</label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date" min="2000-01-01" max="{{ date('Y-m-d H:i:s') }}" name="fecha_hasta"
                    value="{{ $fecha_hasta }}">
            </div>
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1 mx-1">
                <label for="formato"> Formato de Reporte</label><br>
                <select id="formato" name="formato" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">EXCEL</option>
                    <option value="2">PDF</option>
                    <option value="3">HTML</option>
                </select>
            </div>
            <div class="mx-1 flex flex-row items-end justify-between sm:row-start-3 lg:row-start-2 xl:row-start-1">
                <button target="_blank" class="flex justify-evenly  bg-blue-600 rounded-xl px-3 py-2 h-fit" type="submit">
                    <p class="text-white mx-1">Descargar</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
    {{-- end --}}
</div>



    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs font-bold text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Nombre
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Apellido
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Telefono
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-300">
                @forelse($clientes as $cliente)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 px-6">
                            {{ $cliente->nombre }}
                        </td>
                        <td class="py-1 px-6">
                            {{ $cliente->apellido }}
                        </td>
                        <td class="py-1 px-6">
                            {{ $cliente->telefono }}
                        </td>
                    </tr>
                @empty
                    <h3 class="text-xl p-2 bg-slate-600 text-white rounded-lg text-center font-bold mb-3">
                        No se ha encontrado resultados
                    </h3>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
