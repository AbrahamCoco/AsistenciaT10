@section('title', 'Modificar horas')

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
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de servicio</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $con = 1
                            @endphp
                            @foreach ($tipos as $id => $tipo)
                                <tr>
                                    <td class="text-gray-700">{{ $con }}</td>
                                    <td class="text-gray-700">{{ $tipo->tipo }}</td>
                                    <td>
                                        <a href="{{ route('tabla-horas', ['id' => $user->id, 'tipo_id' => $tipo->id]) }}">
                                            <button type="submit" class="btn btn-primary">Seleccionar</button>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $con ++
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
