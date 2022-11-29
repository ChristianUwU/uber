@extends('layouts.app')

@section('contenido')
<h3 class="text-center font-bold text-2xl py-3">
    Editar Usuario {{ $usuario->nombre }}
</h3>

<div class="m-auto w-3/4 p-2 bg-slate-300 rounded-lg border-black">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('usuario.update', $usuario->id) }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <!-- Nombre -->
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{ $usuario->nombre }}" />
        </div>

        {{-- Apellido --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" value="{{ $usuario->apellido }}"  />
        </div>

        {{-- Telefono --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="telefono" :value="__('Teléfono')" />

            <x-text-input id="telefono" class="block mt-1 w-full" type="number" name="telefono" value="{{ $usuario->telefono }}" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="email" :value="__('Correo')" />

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $usuario->email }}" />
        </div>

        <!-- Foto de Usuario -->
        <div class="mt-4">
            <x-input-label for="foto" :value="__('Foto de Perfil')" />

            <input class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            id="foto" type="file" name="foto" value="{{ $usuario->cliente->foto }}" required autofocus />

            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center mt-4">
            {{ __('Actualizar Datos') }}
        </x-primary-button>

    </form>   
</div> 
@endsection