@php
    // dd(Auth()->user()->cliente->id)
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Taxi-Ya') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js',])
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <aside class="fixed h-screen w-16 lg:w-64 bg-gray-500" aria-label="Sidebar">
            <div class="h-screen overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <ul class="space-y-2">

                    {{-- CONDUCTOR --}}
                    <li>
                        <button id="boton" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Conductores</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{route('conductor.index')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Visualizar</a>
                            </li>
                            <li>
                                <a href="{{route('conductor.create')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear (directo)</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Ver solicitudes</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Servicios --}}

                    {{-- <li>

                        <button id="btnServicio" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap text-sm" sidebar-toggle-item>Servicios de Fumigación</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="servicio" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{route('fumi.index')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Visializar Servicio</a>
                            </li>
                            @role('administrador')
                            <li>
                                <a href="{{route('fumi.create')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Registrar Servicio</a>
                            </li>
                            @endrole
                        </ul>

                    {{-- Mi Perfil --}}
                    <li>
                        <button id="btnUser" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Mi Perfil</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="user" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('usuario.show', Auth()->user()) }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Ver mi Perfil</a>
                            </li>
                            <li>
                                <a href="{{ route('usuario.edit', Auth()->user()) }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Editar mi Perfil</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Gestionar Clientes --}}
                    <li>
                        <button id="btnCliente" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Visualizar Clientes</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="cliente" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('cliente.index') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Visualizar Clientes</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Gestionar Vehiculos --}}
                    <li>
                        <button id="btnVehiculo" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <a href="{{ route('vehiculo.index') }}">
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>G. Automóviles</span>
                            </a>
                            {{-- <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> --}}
                        </button>
                        {{-- <ul id="vehiculo" class="hidden py-2 space-y-2">
                            <li>
                            </li>
                        </ul> --}}
                    </li>

                    {{-- SOLICITUDES-ADMINISTRADOR --}}
                    <li>
                        <button id="btnSoli" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Solicitudes</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="soli" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('solicitud.index') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Visualizar Solicitudes</a>
                            </li>
                            <li>
                                <a href="{{route('solicitud.create')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-car-side"></i>
                                    <span>&#160 Postular a conductor</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- <li>
                        <button id="btnVehiculo" type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="fa-regular fa-clipboard"></i>
                            <a href="{{ route('solicitud.envio', Auth()->user()->id) }}">
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Envio</span>
                            </a>
                        </button>
                        
                    </li> --}}

                </ul>
            </div>
        </aside>

        <div class="pl-16 lg:pl-64 h-screen w-full flex flex-col">
            <header class="bg-gray-400">
                @include('layouts.navigation')
            </header>

            <main class="flex-grow bg-gray-200">
                <div class="container p-4">
                    @yield('contenido')
                </div>
            </main>

            <footer class="text-center font-bold p-1 bg-gray-700 text-white">
                <span class="text-lg">&copy; Taxi <span class="font-bold">Ya</span> {{ now()->year }}</span>
            </footer>
        </div>

        {{-- Font Awesome - Iconos --}}
        <script src="https://kit.fontawesome.com/2989636ed8.js" crossorigin="anonymous"></script>
    </body>
</html>

<script>
    // conductor
    const btnBoton = document.querySelector("#boton");
    const boton = document.querySelector("#dropdown-example");
    btnBoton.addEventListener("click", function () {
        boton.classList.toggle("hidden");
    });

    // solicitudes
    const btnSoli = document.querySelector("#btnSoli");
    const soli = document.querySelector("#soli");
    btnSoli.addEventListener("click", function () {
        soli.classList.toggle("hidden");
    });

    // User
    const btnUser = document.querySelector("#btnUser");
    const user = document.querySelector("#user");
    btnUser.addEventListener("click", function () {
        user.classList.toggle("hidden");
    });

    // Cliente
    const btnCliente = document.querySelector("#btnCliente");
    const cliente = document.querySelector("#cliente");
    btnCliente.addEventListener("click", function () {
        cliente.classList.toggle("hidden");
    });



</script>
