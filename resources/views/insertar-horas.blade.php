@section('title', 'Insertar horas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

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
                                <x-jet-label for="name" value="{{ __('Escoge a un prestador de servicio para editar sus horas') }}" />
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Opción</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user_id => $name)
                                            <tr>
                                                <td class="text-gray-700">{{ $user_id }}</td>
                                                <td class="text-gray-700">{{ $name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary">
                                                        <a href="{{ route('horas-registradas', ['id' => $user_id]) }}">Seleccionar tipo</a>
                                                    </button>
                                                </td>
                                            </tr>
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