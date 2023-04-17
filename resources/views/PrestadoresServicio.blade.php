@section('title', 'Servicio')

<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight alineacion">
                {{ __('Prestadores de servicio') }}
            </h2>
    </x-slot>

    @if (session('error') || session('success'))
        <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }}">
            {{ session('error') ? session('error') : session('success')}}
        </div>
    @endif

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <div class="table table-responsive table-striped">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Nombre completo</th>
                                <th>Correo electronico</th>
                                <th>Telefono de contacto</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                                <th>Mas opciones</th>
                            </thead>
                            <tbody>
                                @php
                                    $con = 1
                                @endphp
                                @foreach ($registro as $regis)
                                    <tr>
                                        <td class="text-gray-700">{{$con}}</td>
                                        <td class="text-gray-700">{{$regis->name}}</td>
                                        <td class="text-gray-700">{{$regis->email}}</td>
                                        <td class="text-gray-700">{{$regis->telefono}}</td>
                                        <td class="text-gray-700">
                                            <a href="{{route('Registro.edit', $regis)}}">
                                                <button type="submit" class="btn btn-success">
                                                    <img class="imageR" src="{{ asset('images/editar.png') }}" alt="">
                                                </button>
                                            </a>
                                        </td>
                                        <td class="text-gray-700">
                                            <a href="{{route('Registro.delete', $regis)}}">
                                                <button type="submit" class="btn btn-danger">
                                                    <img class="imageR" src="{{ asset('images/eliminar.png') }}" alt="">
                                                </button>
                                            </a>
                                        </td>
                                        <td class="text-gray-700">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('reportehoras', $regis->id) }}">Descargar Reporte</a>
                                                    <a class="dropdown-item" href="{{ route('contrato', $regis->id) }}">Descargar Contrato</a>
                                                    <a class="dropdown-item" href="#modal{{$regis->id}}" data-toggle="modal">Descargar Reporte Especial</a>
                                                </div>
                                            </div>
                                        </td>
                                        <div class="modal fade" id="modal{{$regis->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$regis->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-gray-800" id="modalLabel">Generar PDF</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('reporte-especial', ['user_id' => $regis->id, 'fecha_inicio' => old('fecha_inicio'), 'fecha_fin' => old('fecha_fin')]) }}" method="GET">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="fecha_inicio" class="text-gray-800">Fecha inicio:</label>
                                                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fecha_fin" class="text-gray-800">Fecha fin:</label>
                                                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Generar PDF</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @php
                                        $con ++
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$registro->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
