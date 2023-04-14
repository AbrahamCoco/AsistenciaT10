@section('title', 'Insertar horas')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inserta horas manualmente a los prestadores de servicio') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="mt-4">
                        <div class="row g-3">
                            <div class="table table-responsive table-striped">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Escoge a un prestador de servicio para editar sus horas') }}
                                </h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Opción</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $con = 1
                                        @endphp
                                        @foreach ($users as $user_id => $name)
                                            <tr>
                                                <td class="text-gray-700">{{ $con }}</td>
                                                <td class="text-gray-700">{{ $name }}</td>
                                                <td>
                                                    <a href="{{ route('horas-registradas', ['id' => $user_id]) }}">
                                                        <button type="button" class="btn btn-primary">Seleccionar tipo</button>
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
            </div>
        </div>
    </div>

</x-app-layout>
