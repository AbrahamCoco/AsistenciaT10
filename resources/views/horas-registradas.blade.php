@section('title', 'Modificar horas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar horas de los prestadores de servicio') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <h3>Horas registradas para {{ $user->name }}, con ID; {{ $user->id }}</h3>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Selecciona el tipo de de servicio que esta haciendo') }}
                    </h2>
                    <form action="{{ route('tabla-horas', ['id' => $user->id, 'tipo_id' => $tipos->first() ? $tipos->first()->id : null]) }}" method="POST">
                        @csrf
                        <select name="tipo_id">
                            <option>Selecciona una opción</option>
                            @foreach ($tipos as $id => $tipo)
                                <option value="{{ $id }}" {{ old('tipo_id') == $id ? 'selected' : '' }}>{{ $tipo }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary">Ver la tabla de horas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
