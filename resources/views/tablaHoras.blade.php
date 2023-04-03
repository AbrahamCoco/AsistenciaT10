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
                            <button type="submit" class="btn btn-info">Agregar hora</button>
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
                                <td class="text-gray-700">{{ $i + 1}}</td>
                                <td class="text-gray-700">{{ $fecha }}</td>
                                <td class="text-gray-700">{{ substr($hora_inicio, 11, 5) }} hrs</td>
                                <td class="text-gray-700">{{ substr($hora_fin, 11, 5) }} hrs</td>
                                <td class="text-gray-700">{{ $horas }}</td>
                                <td>
                                    <a href="">
                                        <button type="submit" class="btn btn-success">
                                            <img class="imageR" src="{{ asset('images/editar.png') }}" alt="">
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <button type="submit" class="btn btn-danger">
                                            <img class="imageR" src="{{ asset('images/eliminar.png') }}" alt="">
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
