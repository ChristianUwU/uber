@extends('layouts.app')

@section('contenido')
    {{-- <div class="grid grid-cols-4">
    <div class="flex justify-center items-center">
        <div class="col-span-1 bg-indigo-700 hover:bg-indigo-900 hover:font-bold text-white px-4 p-2 rounded-md ">
            <i class="fa-solid fa-plus pr-2"></i> <a href="{{ route('conductor.create') }}">Registrar conductor</a>
        </div>
    </div>
</div> --}}

    <h3 class="col-span-3 font-bold text-2xl p-1">
        Conductores Registrados
    </h3>

    <div class="flex p-1 items-center ">

        <div>
            <a href="{{ Route('repo-conductor-xlsx') }}" target="_blank"
                class="py-3 bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Reporte
                EXCEL
            </a>
        </div>

        <div>
            <a href="{{ Route('repo-conductor-html') }}" target="_blank"
                class="py-3 bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Reporte
                HTML
            </a>
        </div>

        <div>
            <a href="{{ Route('downloadPDF') }}" target="_blank"
                class="py-3 bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Reporte
                PDF
            </a>
        </div>


        {{-- Julico --}}
        <form action="{{ Route('repo-conductor-xlsx') }}" id="form" class="hidden lg:block" method="GET">
            <div class="flex mx-3">
                <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
                    <label for="fecha_antes"> Creado Desde</label>
                    <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                    dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        type="date" min="2000-01-01" max="{{ date('Y-m-d H:i:s') }}" name="fecha_antes"
                        value="{{ $fecha_antes }}">
                </div>
                <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1 mx-3">
                    <label for="fecha_hasta"> Creado Hasta</label>
                    <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                    dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        type="date" min="2000-01-01" max="{{ date('Y-m-d H:i:s') }}" name="fecha_hasta"
                        value="{{ $fecha_hasta }}">
                </div>
                <div class="flex flex-row-reverse items-end justify-between sm:row-start-3 lg:row-start-2 xl:row-start-1">
                    <button class="flex justify-evenly  bg-blue-600 rounded-xl px-3 py-2 h-fit" type="submit">
                        <p class="text-white ">Imprimir</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        {{-- end --}}

        {{-- <form action="{{ route('conductor.index') }}" method="GET">
            <input type="text" class="w-1/2 mr-5 rounded-lg border-stone-900" name="texto" value="" placeholder="Buscar">
            <div class="inline p-2 bg-cyan-500  hover:bg-cyan-400 font-bold rounded-md text-lg">
                <input type="submit" class="pr-2" value="Buscar">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
            </div>
        </form> --}}
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
                @foreach ($conductors as $conductor)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <td class="py-1 px-6">
                            {{ $conductor->id }}
                        </td>
                        <td class="py-1 px-6">
                            <span class="py-1 px-6">
                                {{ $conductor->cliente->user->nombre }}
                            </span>
                            <p class="py-1 px-6"> {{ $conductor->created_at }}</p>
                        </td>
                        <td class="py-1 px-6">
                            {{ $conductor->cliente->user->apellido }}
                        </td>
                        <td class="py-1 px-6">
                            {{ $conductor->ci }}
                        </td>
                        <td class="py-1 px-6">
                            {{ $conductor->cliente->user->telefono }}
                        </td>
                        <td class="py-3 px-1">
                            <div class="flex justify-center gap-2">
                                <div class="flex justify-center items-center">
                                    <div
                                        class="col-span-1 bg-indigo-700 hover:bg-indigo-800 hover:font-bold text-white p-1 rounded-md ">
                                        <i class="fa-solid fa-plus pr-2"></i> <a
                                            href="{{ route('conductor.show', $conductor->id) }}">Mostrar</a>
                                    </div>
                                </div>

                                <form action="{{ route('conductor.edit', $conductor->id) }}" method="GET">
                                    @csrf
                                    <x-button-edit>
                                        Editar
                                    </x-button-edit>
                                </form>

                                <form action="{{ route('conductor.destroy', $conductor->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-delete
                                        onclick="return confirm('¿Seguro que desea eliminar el conductor con nombre: {{ $conductor->cliente->user->nombre }} {{ $conductor->cliente->user->apellido }}?' )">
                                        Eliminar
                                    </x-button-delete>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <div>
                    {{-- {{$conductors->links('pagination::tailwind')}} --}}
                </div>

            </tbody>
        </table>
    </div>
@endsection
