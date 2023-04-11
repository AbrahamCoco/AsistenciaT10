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
                    <div class="row">
                        <div class="col-10">
                            <h3 class="text-gray-700">Horas registradas para {{ $user->name }}, con ID; {{ $user->id }}. Que esta prestando servicio como {{ $tipo->tipo }}.</h3>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#agregarHoraModal">Agregar hora</button>
                        </div>
                    </div>
                    <table class="table table-striped color-table-letra">
                        <thead>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora de entrada</th>
                            <th>Hora de salida</th>
                            <th>Horas realizadas</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            @php
                                $totalMinutos = 0;
                                $con = 1
                            @endphp
                            @foreach($horas as $i => $hora)
                            @php
                                $hora_inicio = $hora->hora_inicio ?? '';
                                $hora_fin = $hora->hora_fin ?? '';
                                $fecha = '';
                                $horas = '';
                                if ($hora_inicio && $hora_fin) {
                                    $diff = date_diff(date_create($hora_inicio), date_create($hora_fin));
                                    $horas = sprintf('%d horas y %d minutos', $diff->h, $diff->i);
                                    $totalMinutos += $diff->h * 60 + $diff->i;
                                    $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $hora_inicio)->format('d-m-Y');
                                }
                            @endphp
                            <tr>
                                <td class="text-gray-700">{{ $con }}</td>
                                <td class="text-gray-700">{{ $fecha }}</td>
                                <td class="text-gray-700">{{ substr($hora_inicio, 11, 5) }} hrs</td>
                                <td class="text-gray-700">{{ substr($hora_fin, 11, 5) }} hrs</td>
                                <td class="text-gray-700">{{ $horas }}</td>
                                <td>
                                    <a href="{{ route('editar', ['id' => $user->id, 'tipo_id' => $tipo->id, 'hora_id' => $hora->id]) }}">
                                        <button type="button" class="btn btn-success">
                                            <img class="imageR" src="{{ asset('images/editar.png') }}" alt="">
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('horas-registradas.eliminar', $hora->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <img class="imageR" src="{{ asset('images/eliminar.png') }}" alt="">
                                        </button>
                                    </form>
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

        <div class="modal fade" id="agregarHoraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-gray-700" id="exampleModalLabel">Agregar hora</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('horas-registradas.insert', ['user_id' => $user->id, 'tipo_id' => $tipo->id]) }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="tipo_id" value="{{ $tipo->id }}">
                        <div class="modal-body">
                            <p>Hora de entrada</p>
                            <x-jet-input id="entrada" class="block mt-1 w-full" type="datetime-local" name="entrada" :value="old('entrada')" autofocus />
                            <p>Hora de salida</p>
                            <x-jet-input id="salida" class="block mt-1 w-full" type="datetime-local" name="salida" :value="old('salida')" autofocus />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
