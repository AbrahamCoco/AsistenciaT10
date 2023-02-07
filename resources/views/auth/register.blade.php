@section('title', 'Registrar usuarios')

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                            <x-jet-label for="name" value="{{ __('Nombre Completo') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
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
                                        <option value="Servicio Social">Servicio social</option>
                                        <option value="Practicas Profesionales">Practicas profesionales</option>
                                        <option value="Jovenes Construyendo el Futuro">Jovenes Construyendo el futuro</option>
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
                            <x-jet-label for="direccion" value="{{ __('Direccion de residencia') }}" />
                            <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirma la contraseña') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Estas listo para registrarte?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
