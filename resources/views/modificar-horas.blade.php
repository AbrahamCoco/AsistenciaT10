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
                    @if ($selected_user)
                        <h3>Horas de {{ $users->where('id', $selected_user)->first()->name }}</h3>
                        <div class="table table-responsive table-striped">
                            <table style="border">
                                <thead>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Hora de entrada</th>
                                    <th>Hora de salida</th>
                                    <th>Horas realizadas</th>
                                </thead>
                                <tbody>
                                    @php
                                        $totalMinutos = 0;
                                    @endphp
                                    @foreach ($horas as $i => $asis)
                                        @php
                                            $hora_inicio = $asis->hora_inicio ?? '';
                                            $hora_fin = $asis->hora_fin ?? '';
                                            $fecha = '';
                                            $horas = '';
                                            if ($hora_inicio && $hora_fin) {
                                                $diff = date_diff(date_create($hora_inicio), date_create($hora_fin));
                                                $horas = sprintf('%d horas y %d minutos', $diff->h, $diff->i);
                                                $totalMinutos += ($diff->h * 60) + $diff->i;
                                            }
                                            if ($hora_inicio) {
                                                $fecha = date('d/m/Y', strtotime($asis->fecha));
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $asis->id }}</td>
                                            <td>{{ $fecha }}</td>
                                            <td>{{ $hora_inicio }}</td>
                                            <td>{{ $hora_fin }}</td>
                                            <td>{{ $horas }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5>Total de horas realizadas: {{ floor($totalMinutos / 60) }} horas y {{ $totalMinutos % 60 }} minutos</h5>
                        </div>
                    @else
                        <h3 class="text-gray-800">Selecciona un usuario para ver sus horas trabajadas</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
