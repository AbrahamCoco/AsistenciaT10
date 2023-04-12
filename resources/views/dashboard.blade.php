@section('title', 'Inicio')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    @if (session('error') || session('success'))
        <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }}">
            {{ session('error') ? session('error') : session('success')}}
        </div>
    @endif

    <div>
        <div class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center align-self-center">
                        <div class="section pb-5 pt-sm-2 text-center">
                            <h6 class="mb-0 pb-3"><span>Ya llegue!!!</span><span>Ya me voy!!!</span></h6>
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                            <label for="reg-log"></label>
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Ya llegue!!!</h4>
                                                <div class="form-group">
                                                    <p>Bienvenido a <strong>{{ config('app.name') }}</strong> este es un sistema para tomar tu asistencia y contabilizar las horas realizadas en esta empresa.</p>
                                                </div>
                                                <img class="image" src="{{ asset('images/sonriendoEmoji.png') }}" alt="Emoji">
                                                <form method="POST" action="{{ route('dashboard.horaInicio') }}">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit" id="hora_inicio">Ya llegue!!!</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-back">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Ya me voy!!!</h4>
                                                <div class="form-group">
                                                    <p>Bienvenido a <strong>{{ config('app.name') }}</strong> este es un sistema para tomar tu asistencia y contabilizar las horas realizadas en esta empresa.</p>
                                                </div>
                                                <img class="image" src="{{ asset('images/sonriendoEmoji.png') }}" alt="Emoji">
                                                <form action="{{ route('dashboard.update', $asis?? '') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-danger" type="submit" id="hora_fin">Ya me voy!!!</button>
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
    </div>
</x-app-layout>