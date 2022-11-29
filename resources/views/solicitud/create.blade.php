@extends('layouts.app')

@section('contenido')

<h3 class="text-center font-bold text-2xl py-3">
    Postular a solicitud
</h3>

<div class="m-auto w-3/4 p-2 bg-slate-300 rounded-lg border-black">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('solicitud.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        {{-- Nombre - usuario --}}
        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required />
        </div> --}}

        {{-- Apellido - usuario --}}
        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required />
        </div> --}}

        {{-- CI - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="ci" :value="__('Carnet de Identidad')" />
            <x-text-input id="ci" class="block mt-1 w-full" type="text" name="ci" :value="old('ci')" required/>
        </div>

        {{-- Telefono - usuario --}}
        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')"/>
        </div> --}}

        {{-- fotoAntecedentes - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoAntecedente" :value="__('Foto de antecedentes')" />
            <x-text-input id="fotoAntecedente" class="block mt-1 w-full" type="file" name="fotoAntecedente" :value="old('fotoAntecedente')" required />
        </div>

        {{-- fotod --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="foto" :value="__('Foto conductor')" />
            <x-text-input id="foto" class="block mt-1 w-full" type="file" name="foto" :value="old('foto')" required />
        </div>

        {{-- fotoLicencia - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoLicencia" :value="__('Foto de licencia')" />
            <x-text-input id="fotoLicencia" class="block mt-1 w-full" type="file" name="fotoLicencia" :value="old('fotoLicencia')" required />
        </div>

        {{-- fotoTIC - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoTIC" :value="__('Foto TIC')" />
            <x-text-input id="fotoTIC" class="block mt-1 w-full" type="file" name="fotoTIC" :value="old('fotoTIC')" required />
        </div>

        {{-- fotoPapelesAuto - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoPapelesAuto" :value="__('Foto de los papeles del auto con el que desee trabajar')" />
            <x-text-input id="fotoPapelesAuto" class="block mt-1 w-full" type="file" name="fotoPapelesAuto" :value="old('fotoPapelesAuto')" required />
        </div>

        {{-- fotoCI_Anverso - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoCI_Anverso" :value="__('Foto de CI (Anverso)')" />
            <x-text-input id="fotoCI_Anverso" class="block mt-1 w-full" type="file" name="fotoCI_Anverso" :value="old('fotoCI_Anverso')" required />
        </div>

        {{-- fotoCI_Reverso - solicitud --}}
        <div class="mt-4">
            <x-input-label class="text-gray-800" for="fotoCI_Reverso" :value="__('Foto de CI (Reverso)')" />
            <x-text-input id="fotoCI_Reverso" class="block mt-1 w-full" type="file" name="fotoCI_Reverso" :value="old('fotoCI_Reverso')" required />
        </div>

        
        {{-- email - usuario --}}
        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div> --}}


        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>


        <div class="mt-4">
            <x-input-label class="text-gray-800" for="password_confirmation" :value="__('Repetir Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div> --}}

        {{-- <div class="mt-4">
            <x-input-label class="text-gray-800" for="image" :value="__('Foto de Perfil')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required />
        </div> --}}

        {{-- <input name="rol" type="text" value="empleado" class="hidden"> --}}

        <x-primary-button class="w-full justify-center mt-4">
            {{ __('Enviar Solicitud') }}
        </x-primary-button>

    </form>   
</div>  

@endsection