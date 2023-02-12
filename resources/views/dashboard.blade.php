@section('title', 'Inicio')

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="media">
                    <img class="mr-3 image" src="{{ asset('images/sonriendoEmoji.png') }}" alt="Emoji">
                    <div class="parrafo">
                        <p>Bienvenido a <strong>{{ config('app.name') }}</strong> este es un sistema para tomar tu asistencia y contabilizar las horas realizadas en esta empresa.</p>
                        <p>Esta es la prueba de que son ramas diferentes master y devt10</p>
                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <form method="POST" action="{{ route('dashboard.horaInicio') }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit" id="hora_inicio">Ya llegue!!!</button>
                                    </form>
                                </div>
                                <div class="col-6">
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
</x-app-layout>
