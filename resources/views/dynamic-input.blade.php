@section('title', 'Insertar horas')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inserta horas manualmente a los prestadores de servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <form action=" {{ route('dynamic-input.insert') }} " method="POST">
                        @csrf
                        <div class="table table-responsive table-striped">
                            <table id="tabla">
                                <thead class="text-center">
                                    <th>Prestador de servicio</th>
                                    <th>Fecha/Hora de entrada</th>
                                    <th>Fecha/Hora de salida</th>
                                </thead>
                                <tbody>
                                    <tr id="fila-clonable">
                                        <td>
                                            <select name="id_user">
                                                <option>Selecciona una opcion</option>
                                                @foreach ($users as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <x-jet-input id="entrada" class="block mt-1 w-full" type="datetime-local" name="entrada" :value="old('entrada')" autofocus />
                                        </td>
                                        <td>
                                            <x-jet-input id="salida" class="block mt-1 w-full" type="datetime-local" name="salida" :value="old('salida')" autofocus />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">
                                Insertar horas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-info margin btn-agregar-fila">
                Agregar fila
            </button> --}}
        </div>
    </div>

</x-app-layout>
