@section('title', 'Servicio')

<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight alineacion">
                {{ __('Prestadores de servicio') }}
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <div class="table table-responsive table-striped">
                        <table>
                            <thead class="text-center">
                                <th>Nombre completo</th>
                                <th>Correo electronico</th>
                                <th>Telefono de contacto</th>
                                <th>Tipo de usuario</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                                <th>Reporte</th>
                                <th>Contrato</th>
                            </thead>
                            <tbody>
                                @foreach ($registro as $regis)
                                    <tr>
                                        <td class="itemR">{{$regis->name}}</td>
                                        <td class="itemR">{{$regis->email}}</td>
                                        <td class="itemR">{{$regis->telefono}}</td>
                                        <td class="itemR">{{$regis->tipo}}</td>
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
