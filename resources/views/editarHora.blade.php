@section('title', 'Editar hora')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edita la hora seleccionada del prestador de servicios') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <p>La hora que vas a actualizar es la siguiente:</p>
                    <div class="row">
                        <div class="col-6">
                            <p>Hora de entrada: {{ $hora_inicio }}</p>
                        </div>
                        <div class="col-6">
                            <p>Hora de salida: {{ $hora_fin }}</p>
                        </div>
                    </div>
                    <p>A continuacion se muestran los campos para actualizar las horas realizadas del prestador de servicio</p>
                    <form action="{{ route('actualizar', ['id' => $user_id, 'tipo_id' => $tipo_id, 'hora_id' => $hora_id]) }}" method="POST">
                        @csrf

                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="hora_id" value=" {{ session('hora_id') }} ">
                                {{-- <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="tipo_id" value="{{ $tipo->id }}"> --}}
                                <p>Hora de entrada</p>
                                <x-jet-input id="entrada" class="block mt-1 w-full" type="datetime-local" name="entrada" :value="old('entrada')" autofocus />
                            </div>
                            <div class="col-6">
                                <p>Hora de salida</p>
                                <x-jet-input id="salida" class="block mt-1 w-full" type="datetime-local" name="salida" :value="old('salida')" autofocus />
                            </div>
                        </div>
                        <div class="py-4">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
