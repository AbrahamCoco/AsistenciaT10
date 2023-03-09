@section('title', 'Servicio')

<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight alineacion">
                {{ __('Prestadores de servicio') }}
            </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <div class="table table-responsive table-striped">
                        <table>
                            <thead class="text-center">
                                <th>Nombre completo</th>
                                <th>Correo electronico</th>
                                <th>Telefono de contacto</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                                <th>Reporte</th>
                                <th>Contrato</th>
                                <th>Reporte Auxliar</th>
                            </thead>
                            <tbody>
                                @foreach ($registro as $regis)
                                    <tr>
                                        <td class="itemR">{{$regis->name}}</td>
                                        <td class="itemR">{{$regis->email}}</td>
                                        <td class="itemR">{{$regis->telefono}}</td>
                                        <td class="itemR">
                                            <button type="submit" class="btn btn-success">
                                                <a href="{{route('Registro.edit', $regis)}}">
                                                    <img class="imageR" src="{{ asset('images/editar.png') }}" alt="">
                                                </a>
                                            </button>
                                        </td>
                                        <td class="itemR">
                                            <button type="submit" class="btn btn-danger">
                                                <a href="{{route('Registro.delete', $regis)}}">
                                                    <img class="imageR" src="{{ asset('images/eliminar.png') }}" alt="">
                                                </a>
                                            </button>
                                        </td>
                                        <td class="itemR">
                                            <button type="submit" class="btn btn-info">
                                                <a href="{{ route('reportehoras', $regis->id) }}">
                                                    <img class="imageR" src="{{ asset('images/descargarpdf.png') }}" alt="">
                                                </a>
                                            </button>
                                        </td>
                                        <td class="itemR">
                                            <button type="submit" class="btn btn-info">
                                                <a href="{{route('contrato', $regis->id)}}">
                                                    <img class="imageR" src="{{ asset('images/descargarpdf.png') }}" alt="">
                                                </a>
                                            </button>
                                        </td>
                                        <td class="itemR">
                                            <button type="submit" class="btn btn-info">
                                                <a href="#modal{{$regis->id}}" data-toggle="modal">
                                                    <img class="imageR" src="{{ asset('images/descargarpdf.png') }}" alt="">
                                                </a>
                                            </button>
                                            <div class="modal fade" id="modal{{$regis->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$regis->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Generar PDF</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('pdf_auxiliar', $regis->id) }}" method="GET">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="fecha_inicio">Fecha inicio:</label>
                                                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="fecha_fin">Fecha fin:</label>
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
                                        </td>
                                    </tr>
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
