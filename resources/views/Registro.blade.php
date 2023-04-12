@section('title', 'Registro')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alta de nuevo prestador de servicio') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <form method="POST" action="{{ route('Registro.store') }}">
                        @csrf

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <x-jet-label for="name" value="{{ __('Nombre Completo') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <div class="col-6">
                                    <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-3">
                                    <x-jet-label for="fom" value="{{ __('Folio o Matricula') }}" />
                                    <x-jet-input id="fom" class="block mt-1 w-full" type="text" name="fom" :value="old('fom')" autofocus />
                                </div>
                                <div class="col-3">
                                    <x-jet-label for="telefono" value="{{ __('Telefono de contacto') }}" />
                                    <x-jet-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" autofocus />
                                </div>
                                <div class="col-3">
                                    <x-jet-label for="tipo" value="{{ __('Tipo')}}" />
                                    <select name="tipo">
                                        <option value="Servicio Social">Servicio Social</option>
                                        <option value="Practicas Profesionales">Practicas Profesionales</option>
                                        <option value="Jovenes Construyendo el Futuro">Jovenes Construyendo el Futuro</option>
                                        <option value="Externo">Externo</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <x-jet-label for="fechaAgenda" value="{{ __('Fecha de agenda')}}" />
                                    <x-jet-input id="fechaAgenda" class="block mt-1 w-full" type="date" name="fechaAgenda" :value="old('fechaAgenda')" autofocus />
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
                            <div class="row g-3">
                                <div class="col-6">
                                    <x-jet-label for="direccion" value="{{ __('Direccion de residencia') }}" />
                                    <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" />
                                </div>
                                <div class="col-6">
                                    <x-jet-label for="rol" value="{{ __('Rol que ocupara en la empresa')}}"/>
                                    <label class="text-gray-700">
                                        <input type="radio" name="rol" value="PrestadorDeServicio">
                                        Prestador de servicio
                                    </label>
                                    <label class="text-gray-700">
                                        <input type="radio" name="rol" value="Administrador">
                                        Administrador
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                                <div class="col-6">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirma la contraseña') }}" />
                                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms" required />

                                        <div class="ml-2">
                                            {!! __('Estoy de acuerdo con los :terms_of_service y :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terminos de Servicio').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Politicas de Privacidad').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-jet-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">

                            <x-jet-button class="ml-4">
                                {{ __('Registrar') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
