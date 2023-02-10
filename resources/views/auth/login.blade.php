@section('title', 'Inicio de sesion')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

<x-guest-layout>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h2 class="mb-4 pb-3 text-centere">{{ __('Iniciar Sesion') }}</h2>

                                            <x-jet-validation-errors class="mb-4" />
                                            @if (session('status'))
                                                <div class="mb-4 font-medium text-sm text-green-600">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf

                                                <div class="form-group">
                                                    <x-jet-label class="color-write" for="email" value="{{ __('Correo electronico') }}" />
                                                    <x-jet-input id="email" class="form-style" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" />
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>	
                                                <div class="form-group mt-2">
                                                    <x-jet-label class="color-write" for="password" value="{{ __('Contraseña') }}" />
                                                    <x-jet-input id="password" class="form-style" type="password" name="password" required autocomplete="current-password" autocomplete="off" />
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>

                                                @if (Route::has('password.request'))
                                                    <p class="mb-0 mt-4 text-center"><a href="{{ route('password.request') }}" class="link underline text-sm text-gray-600 hover:text-gray-900">{{ __('Se te olvido tu contraseña?') }}</a></p>
                                                @endif

                                                <x-jet-button class="btn mt-4">
                                                    {{ __('Iniciar Sesion') }}
                                                </x-jet-button>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>