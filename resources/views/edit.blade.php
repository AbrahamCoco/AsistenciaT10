@section('title', 'Editar prestador de servicios')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edita los campos necesarios para actualizar la informacion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container contenedor">
                    <form method="POST" action="{{ route('Registro.update', $registro) }}">
                        @csrf

                        @method('put')

                        <div>
                            <input type="hidden" name="user_id" value="{{session('user_id')}}">
                            <x-jet-label for="name" value="{{ __('Nombre Completo') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" value="{{$registro->name}}"/>
                        </div>

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-auto">
                                    <x-jet-label for="fom" value="{{ __('Folio o Matricula') }}" />
                                    <x-jet-input id="fom" class="block mt-1 w-full" type="text" name="fom" :value="old('fom')" autofocus value="{{$registro->fom}}"/>
                                </div>
                                <div class="col-auto">
                                    <x-jet-label for="telefono" value="{{ __('Telefono de contacto') }}" />
                                    <x-jet-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" autofocus value="{{$registro->telefono}}"/>
                                </div>
                                <div class="col-auto">
                                    <x-jet-label for="tipo" value="{{ __('Tipo')}}" />
                                    <select name="tipo" value="{{$registro->tipo}}">
                                        <option value="Servicio Social">Servicio social</option>
                                        <option value="Practicas Profesionales">Practicas profesionales</option>
                                        <option value="Jovenes Construyendo el Futuro">Jovenes Construyendo el futuro</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <x-jet-label for="fechaAgenda" value="{{ __('Fecha de agenda')}}" />
                                    <x-jet-input id="fechaAgenda" class="block mt-1 w-full" type="date" name="fechaAgenda" :value="old('fechaAgenda')" autofocus/>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <x-jet-label for="ce" value="{{ __('Clave de Elector (CE)') }}" />
                                    <x-jet-input id="ce" class="block mt-1 w-full" type="text" name="ce" :value="old('ce')" autofocus />
                                </div>
                                <div class="col-6">
                                    <x-jet-label for="curp" value="{{ __('Clave Unica de Registro de Poblacion (CURP)') }}" />
                                    <x-jet-input id="curp" class="block mt-1 w-full" type="text" name="curp" :value="old('curp')" autofocus />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="direccion" value="{{ __('Direccion de residencia') }}" />
                            <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" value="{{$registro->direccion}}"/>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required value="{{$registro->email}}"/>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirma la contraseña') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Guardar') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>